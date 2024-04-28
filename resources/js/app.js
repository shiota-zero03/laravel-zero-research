import './bootstrap';

import { initializeApp } from "firebase/app";
import { getMessaging, getToken, onMessage } from "firebase/messaging";

const firebaseConfig = {
    apiKey: "AIzaSyBwa4dqv771laXM7oEZVSt-UK7JYyp3AmE",
    authDomain: "test-firebase-55ab2.firebaseapp.com",
    projectId: "test-firebase-55ab2",
    storageBucket: "test-firebase-55ab2.appspot.com",
    messagingSenderId: "712028884929",
    appId: "1:712028884929:web:16a6a921e9e5a893f36940",
    measurementId: "G-PH2RNXSSH6"
};

const app = initializeApp(firebaseConfig);
const messaging = getMessaging(app);

if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('firebase-messaging-sw.js')
    .then((registration) => {
        console.log('Service Worker registered:', registration);
    })
    .catch((err) => {
        console.log('An error occurred while registering the service worker:', err);
    });
}

onMessage(messaging, (payload) => {
    console.log('Message received. ', payload);
    alert('ada notifikasi baru')
});

getToken(messaging, {
    vapidKey: 'BK1U_jNSj_0pMmZYqMNzIzyh0an4k34ROKOH4CjkosJotSmtV3oybJirTuTbw30OmUh7ro6FjYe8Yqnhfbw8uwY'
}).then((currentToken) => {
    if (currentToken) {
        console.log('Token:', currentToken);
        sendTokenToServer(currentToken)
    } else {
        requestPermission();
        console.log('No registration token available. Request permission to generate one.');
    }
})
.catch((err) => {
    console.log('An error occurred while retrieving token. ', err);
});

function requestPermission() {
    Notification.requestPermission().then((permission) => {
        if (permission === 'granted') {
            console.log('Notification permission granted.');
        } else {
            alert('Unable to get permission to notify.');
        }
    });
}

requestPermission()

function sendTokenToServer(token){
    var csrf = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content');

    let formData = new FormData();
    formData.append("device_token", token);
    fetch("/get-token", {
        headers: {
            "X-CSRF-Token": csrf,
            _method: "_POST"
        },
        method: "POST",
        credentials: "same-origin",
        body: formData,
    }).then((response) => {
        console.log(response.status)
        console.log(response)
    })
}
