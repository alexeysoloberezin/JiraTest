<script setup>
import {computed, ref, toRefs} from "vue";
import Avatar from "@/Components/Users/Avatar.vue";
import {Link, router} from "@inertiajs/vue3";
import GroupButtons from "@/Components/Buttons/GroupButtons.vue";

const props = defineProps(['user', 'isLink', 'isFriend'])

const {name, position, email, create_at, img, id} = toRefs(props.user)

const linkType = computed(() => {
    return props?.isLink ? Link : 'div';
});

const addFriend = () => {
    if (!props.user) return console.log('no user')
    const id = props.user?.id
    router.post(route('add-friend', {id: id}))
}

const removeFriend = () => {
    if (!props.user) return console.log('no user')
    const id = props.user?.id
    router.post(route('remove-friend', {id: id}))
}

const getBtns = computed(() => {
    const res = [
        {
            text: 'Profile',
            link: route('users.show', {id: props.user.id})
        }
    ]

    if (!props?.isFriend) {
        res.push({
            text: 'Add friend',
            cb: addFriend
        })
    }else{
        res.push({
            text: 'Remove from friends',
            cb: removeFriend
        })
    }

    return res
})
</script>

<template>
    <component :is="linkType" :href="isLink ? route('users.show', {id: user.id}) : ''"
               class="flex flex-col p-4 w-full border-gray-200 border rounded-lg">
        <div class="flex items-center pb-2 w-full flex-grow-1 h-full">
            <Avatar :user="user"/>
            <div class="flex-grow ml-2">
                <h2 class="text-gray-900 title-font font-medium">{{ name }}</h2>
                <p class="text-gray-500">{{ position }}</p>
                {{ create_at }}
                <div class="sliceText text-sm" style="--sliceVal: 2;">
                    {{ user.content }}
                </div>
            </div>
        </div>
        <div>
            <div class="inline-flex rounded-md shadow-sm" role="group">
                <GroupButtons
                    :btns="getBtns"
                />
            </div>
        </div>
    </component>
</template>

<style scoped>

</style>
