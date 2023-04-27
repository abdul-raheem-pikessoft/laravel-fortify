// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyCq1thoYtK6HVLB50d67d0uv0Mq7C99Gi4",
    authDomain: "notification-ae4b0.firebaseapp.com",
    projectId: "notification-ae4b0",
    storageBucket: "notification-ae4b0.appspot.com",
    messagingSenderId: "971257201145",
    appId: "1:971257201145:web:d61eb4e5855178348d3d28",
    measurementId: "G-HCRTXJZG7V"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
