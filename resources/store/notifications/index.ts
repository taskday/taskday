import { usePage } from "@inertiajs/inertia-vue3";
import axios from "axios";
import { defineStore } from "pinia";

export const useNotificationsStore = defineStore("notifications", {
  state: () => ({
    total: 0,
    notifications: [],
  }),
  getters: {
    hasUnread: (state) => {
      return state.total > 0;
    },
  },
  actions: {
    setTotal(total) {
      this.total = total;
    },
    setNotifications(notifications) {
      this.notifications = notifications;
    },
    resetState() {
      this.total = 0;
      this.notifications = [];
    },
    /**
     * Fetch notifications.
     *
     * @param {Number} limit
     */
    fetch(limit = 20) {
      console.log("Fetching notifications...");
      axios.get("/api/notifications", { params: { limit } }).then(({ data: { total, notifications } }) => {
        this.total = total;
        this.notifications = notifications.map(({ id, data, created }) => {
          return {
            id: id,
            title: data.title,
            body: data.body,
            created: created,
            user: data.user,
            url: data.url,
          };
        });
      });
    },
    /**
     * Mark the given notification as read.
     *
     * @param {Object} notification
     */
    markAsRead({ id }) {
      const index = this.notifications.findIndex((n) => n.id === id);
      if (index > -1) {
        this.setTotal(this.total - 1);
        this.setNotifications(this.notifications.filter((n) => n.id !== id));
        axios.patch(`/api/notifications/${id}/read`).then(() => {
          this.fetch();
        });
      }
    },
    /**
     * Mark all notifications as read.
     */
    markAllRead() {
      this.resetState();
      axios.post("/api/notifications/mark-all-read");
    },
    /**
     * Listen for Echo push notifications.
     */
    listen() {
      let page = usePage();
      //@ts-ignore
      window.Echo.private(`App.Models.User.${page.props.value.user.id}`)
        .notification((notification) => {
          console.log(notification);
          this.setTotal(this.total + 1);
          this.setNotifications(this.notifications.unshift(notification));
        })
        .listen("NotificationRead", ({ notificationId }) => {
          this.setTotal(this.total - 1);
          const index = this.notifications.findIndex((n) => n?.id === notificationId);
          if (index > -1) {
            this.setNotifications(this.notifications.slice(index));
          }
        })
        .listen("NotificationReadAll", () => {
          this.resetState();
        });
    },
  },
});
