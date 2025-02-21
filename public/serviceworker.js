self.addEventListener("install", (event) => {
    event.waitUntil(
        caches.open("static-cache").then((cache) => {
            return cache.addAll([
                "/assets/style.css",
                "/",
            ]);
        })
    );
    self.skipWaiting();
});

self.addEventListener("fetch", (event) => {
    event.respondWith(
        caches.match(event.request).then((response) => {
            return response || fetch(event.request);
        })
    );
});
