/** 
 * importing all the styles 
 */
import "@/css/app.css";

/** 
 * Registering the service worker for push notifications 
 */
import './register-sw';

/**
 * Setting window env object
 */
window.env = {
  VITE_PUSHER_APP_KEY: '',
  VITE_PUSHER_APP_CLUSTER: '',
  VITE_VAPID_PUBLIC_KEY: '',
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
 import Echo from "laravel-echo";
 import Pusher from "pusher-js";
 window.Pusher = Pusher;
 window.Echo = new Echo({
   broadcaster: "pusher",
   key: window.env.VITE_PUSHER_APP_KEY,
   cluster: window.env.VITE_PUSHER_APP_CLUSTER,
   forceTLS: true
 });

/**
 * Set keys for web standard push notifications with a global object.
 */
 window.Laravel = {};
 window.Laravel.vapidPublicKey = window.env.VITE_VAPID_PUBLIC_KEY;
 
/**
 * Inertia Progress
 */
 import { InertiaProgress } from "@inertiajs/progress";
 InertiaProgress.init({
   delay: 100,
   color: "#29d",
   includeCSS: true,
   showSpinner: false,
 });
