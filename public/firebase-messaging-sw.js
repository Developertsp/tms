importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

var firebaseConfig = {
    apiKey: "AIzaSyAUkLuVFDDnjRWeWwgPmyQ6X4s-agy8LNo",
    authDomain: "notification-3804c.firebaseapp.com",
    projectId: "notification-3804c",
    storageBucket: "notification-3804c.appspot.com",
    messagingSenderId: "201355403250",
    appId: "1:201355403250:web:1d9bcb3904843fa9d0156b",
    measurementId: "G-6YYXRPRGG9"
};

firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();

messaging.onBackgroundMessage(function(payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);
    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
        icon: payload.notification.icon
    };

    self.registration.showNotification(notificationTitle, notificationOptions);
});
