import http.server
import socketserver
import sys
import mimetypes

mimetypes.add_type('image/webp', '.webp')

class NoCacheHTTPRequestHandler(http.server.SimpleHTTPRequestHandler):
    # Buffered writes: on Windows an unbuffered socket can accept only part of a
    # large file, which silently truncated CSS/JS responses under load.
    wbufsize = -1
    protocol_version = 'HTTP/1.1'
    def end_headers(self):
        self.send_header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
        self.send_header('Pragma', 'no-cache')
        self.send_header('Expires', '0')
        super().end_headers()

if __name__ == '__main__':
    port = 3000
    if len(sys.argv) > 1:
        port = int(sys.argv[1])
    socketserver.ThreadingTCPServer.allow_reuse_address = True
    socketserver.ThreadingTCPServer.daemon_threads = True
    with socketserver.ThreadingTCPServer(("", port), NoCacheHTTPRequestHandler) as httpd:
        print(f"Serving HTTP on 0.0.0.0 port {port} (no-cache enabled)...", flush=True)
        try:
            httpd.serve_forever()
        except KeyboardInterrupt:
            pass
