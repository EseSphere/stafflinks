const cacheName = "workSphere-cache-v1";
const cacheUrls = [
  "./dashboard",
  "./header-contents",
  "https://cdn.jsdelivr.net/npm/geodesy@2/latlon-spherical.min.js",
  "./care-plan",
  "./view-timesheet",
  "assets/img/gsLogo.png",
  "img/avatar/avatar-illustrated-01.png",
  "feather-icons/calendar.svg",
  "feather-icons/clock.svg",
  "https://cdn.jsdelivr.net/npm/geodesy@2/latlon-spherical.min.js",
  "./img/avatar/avatar-illustrated-02.png",
  "./img/avatar/avatar-illustrated-01.webp",
  ];

// Installing the Service Worker
self.addEventListener("install", async (event) => {
  try {
    const cache = await caches.open(cacheName);
    await cache.addAll(cacheUrls);
  } catch (error) {
    console.error("Service Worker installation failed:", error);
  }
});

// Fetching resources
self.addEventListener("fetch", (event) => {
  event.respondWith(
    (async () => {
      const cache = await caches.open(cacheName);

      try {
        const cachedResponse = await cache.match(event.request);
        if (cachedResponse) {
          console.log("cachedResponse: ", event.request.url);
          return cachedResponse;
        }

        const fetchResponse = await fetch(event.request);
        if (fetchResponse) {
          console.log("fetchResponse: ", event.request.url);
          await cache.put(event.request, fetchResponse.clone());
          return fetchResponse;
        }
      } catch (error) {
        console.log("Fetch failed: ", error);
        const cachedResponse = await cache.match("dashboard.php");
        return cachedResponse;
      }
    })()
  );
});
