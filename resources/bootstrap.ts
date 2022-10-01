/** 
 * importing all the styles 
 */
import "@/css/app.css";

/** 
 * Registering the service worker for push notifications 
 */
import './register-sw';

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
   key: window.env.pusherAppKey,
   cluster: window.env.pusherAppCluster,
   forceTLS: true
 });
 
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
