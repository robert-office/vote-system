import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;
window.Echo = new Echo({
   broadcaster: 'pusher',
   key: 'local',
   wsHost: '127.0.0.1',
   wsPort: 6001,
   forceTLS: false,
   disableStats: true
});
