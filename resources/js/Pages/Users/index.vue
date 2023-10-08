<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import UserBox from "@/Components/Users/UserBox.vue";
import {computed} from "vue";

const props = defineProps({users: Object, currentUserFriends: Object, myId: Number})

const filteredUsers = computed(() => {
    const myId = props?.myId

    if(!myId || !Array.isArray(props.currentUserFriends)) return props.users

    return  props.users.filter(user => (
        !props.currentUserFriends.some(el => (el.pivot.user_id === myId && el.pivot.friend_id === user.id)) &&
        !props.currentUserFriends.some(el => (el.pivot.friend_id === myId && el.pivot.user_id === user.id))
    ))
})


// user 1 -  user1@gmil.com 123123123
// user 2 -  user2@gmil.com 123123123

</script>

<template>
    <AuthenticatedLayout>
        <section class="text-gray-600 body-font">
            <div class="container px-5 py-20 mx-auto">
                <div class="flex flex-col text-center w-full mb-5">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Our Users</h1>
                    <p class="lg:w-2/3 mx-auto leading-relaxed text-base">You can find users for your team</p>
                </div>
                <div v-if="Array.isArray(currentUserFriends)" class="mb-5">
                    <h3 class="text-2xl mb-2 text-black">Your friends</h3>
                    <div class="grid grid-cols-3 gap-3">
                        <UserBox
                            v-for="user in currentUserFriends"
                            :key="user.id"
                            :user="user"
                            :isLink="true"
                            :isFriend="true"
                        />
                    </div>
                </div>
                <div v-if="Array.isArray(filteredUsers)" >
                    <h3 class="text-2xl mb-2 text-black">Other users</h3>

                    <div class="grid grid-cols-3 gap-3">
                        <UserBox
                            v-for="user in filteredUsers"
                            :key="user.id"
                            :user="user"
                            :isLink="true"
                        />
                    </div>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
