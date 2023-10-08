<script setup>
import TaskListItem from "@/Components/tasks/TaskListItem.vue";
import {computed, ref} from "vue";
import draggable from 'vuedraggable'
import {router, useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import DeleteButton from "@/Components/Buttons/DeleteButton.vue";
import { Link } from '@inertiajs/vue3'

const props = defineProps(['category'])

const category = ref(props.category || null)

const newColumnName = ref('')

const drag = ref(false);

const validate = () => {
    errors.value.text = false;
    errors.value.title = false;

    if (!newTask.value.text) {
        errors.value.text = true;
        return false
    }

    if (!newTask.value.title) {
        errors.value.title = true;
        return false
    }
    return true
}
const addTask = () => {
    if (!validate()) return null

    if (Array.isArray(category.value.task_columns) && category.value.task_columns.length > 0) {
        router.post('/task', {
            text: newTask.value.text,
            title: newTask.value.title,
            category_id: category.value.id,
            task_column_id: category.value.task_columns[0].id
        })
    }
}

const saveTable  = () => {
    const finishCategoryTable = {
        ...category.value,
        task_columns: category.value.task_columns.map(taskColumn => {
            return {
                ...taskColumn, task_ids: JSON.stringify(taskColumn.tasks.map(el => el.id))
            }
        })
    }
    router.put('/task-columns', {
        task_columns: finishCategoryTable,
        category_id: category.value.id
    })
}

const errorAddColumn = ref('')
const addColumn = () => {
    if(!newColumnName.value) return errorAddColumn.value = 'border-b border-red-400';
    errorAddColumn.value = ''

    router.post('/task-columns', {
        title: newColumnName.value,
        task_ids: JSON.stringify([]),
        category_id: category.value?.id
    })
}
const deleteColumn = (item) => {
    router.delete('/task-columns/' + item.id)
}

const newTask = ref({
    title: '',
    text: '',
})
const errors = ref({
    title: false,
    text: false,
})

const dragOptions = computed(() => {
    return {
        animation: 500,
        group: "description",
        disabled: false,
        ghostClass: "ghost"
    }
})
</script>

<template>
    <div v-if="Array.isArray(category?.task_columns) && category?.task_columns.length > 0">
        <div class="flex justify-between  mt-4">
            <div class="flex gap-2">
                <TextInput v-model="newTask.title" :placeholder="'Title'" :height="'h-[34px]'" :error="errors.title"
                           @input="validate"/>
                <TextInput v-model="newTask.text" :placeholder="'Text'" :height="'h-[34px]'" :error="errors.text"
                           @input="validate"/>
                <PrimaryButton @click="addTask">Add task</PrimaryButton>
            </div>
        </div>
    </div>

    <div v-if="Array.isArray(category?.task_columns)"

         class="flex gap-x-3 gap-y-1 my-5 rounded-4 rounded p-3 overflow-x-auto">

        <div v-for="tableItem in category?.task_columns" class="flex-shrink-0">
            <div class="font-bold flex align-items-center justify-between mb-2" style="align-items: center">
                <input type="text"
                       v-model="tableItem.title"
                       @focusout="saveTable"
                       placeholder="Title-placeholder"
                       class="h-[24px] border-0 placeholder-gray-400 w-full bg-transparent focus:border-transparent pl-1"
                >
                <DeleteButton class="ml-2 opacity-50 hover:opacity-75" @click="deleteColumn(tableItem)"/>
            </div>

            <div>
                <draggable v-bind="dragOptions"  @change="saveTable" :list="tableItem.tasks" class="list-group min-h-[70vh] bg-gray-50"
                           group="a" item-key="id">
                    <template #item="{ element }">
                        <Link :href="route('task.show', {id: element.id})">
                            <TaskListItem
                                :task="element"
                                class="mb-2"
                            />
                        </Link>
                    </template>
                </draggable>
            </div>
        </div>
        <div class=" flex-shrink-0">
            <div class="font-bold mb-2">
                <input type="text" v-model="newColumnName" placeholder="Title-placeholder"
                       :class="errorAddColumn"
                       class="h-[35px] border-0 placeholder-gray-400 bg-transparent focus:border-transparent pl-1 w-full">
            </div>
            <div @click="addColumn"
                 class="list-group min-h-[200px] bg-gray-50 flex justify-center cursor-pointer hover:bg-gray-200 transition">
                <svg class="max-w-[50px] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><title>
                    plus</title>
                    <path d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z"/>
                </svg>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
