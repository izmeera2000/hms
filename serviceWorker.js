const staticHMS = "HMS";
const assets = [
  
  "/index.php",
  "/signin.php",
  "/signup.php",
  "/applyform.php",
  "/payment.php",
  "/roomdetails.php",
  "/studentlist.php",
  "/controller/server.php",

  "/css/style.css",
  "/js/main.js",

];

self.addEventListener("install", installEvent => {
  installEvent.waitUntil(
    caches.open(staticHMS).then(cache => {
      cache.addAll(assets);
    })
  );
});

self.addEventListener("fetch", fetchEvent => {
  fetchEvent.respondWith(
    caches.match(fetchEvent.request).then(res => {
      return res || fetch(fetchEvent.request);
    })
  );
});
