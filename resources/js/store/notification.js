// stores/notification.js
import { defineStore } from 'pinia'
import axios from 'axios'
import {router} from "@inertiajs/vue3";

export const useNotificationStore = defineStore('notification', {
    state: () => {
        return { count: 0 }
    },
    // state: () => ({ count: 0 })
    actions: {
        async fetchFriendList() {
            try {

            }catch (err){
                console.log('err', err)
            }
        }
    },
})
