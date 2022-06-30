<template>
    <h1>Tasks</h1>

    <v-row justify="center">
        <div class="text-center">
            <v-btn color="primary" @click="createTask">Create Task</v-btn>
            <v-dialog v-model="taskDialog">
                <v-card>
                    <v-card-text>
                        <v-row>
                            <v-col :lg="6" :cols="12">
                                <v-text-field v-model="task.key" label="Key" readonly></v-text-field>
                            </v-col>
                            <v-col :lg="6" :cols="12">
                                <label>Due Date</label>
                                <datepicker v-model="task.due_date"></datepicker>
                            </v-col>
                            <v-col :lg="6" :cols="12">
                                <v-text-field v-model="task.summary" label="Summary"></v-text-field>
                            </v-col>
                            <v-col :lg="6" :cols="12">
                                <v-textarea v-model="task.description" label="Description"></v-textarea>
                            </v-col>
                            <v-col :lg="6" :cols="12">
                                <v-autocomplete v-model="task.assigned_to" :items="users" item-title="name" item-value="id" label="Assigned To"></v-autocomplete>
                            </v-col>
                            <v-col :lg="6" :cols="12">
                                <v-autocomplete v-model="task.status_id" :items="statuses" item-title="name" item-value="id" label="Status"></v-autocomplete>
                            </v-col>
                        </v-row>
                    </v-card-text>
                    <v-card-actions>
                        <v-row>
                            <v-col :cols="6">
                                <v-btn color="green" block @click="saveTask">Save</v-btn>
                            </v-col>
                            <v-col :cols="6">
                                <v-btn color="red" block @click="cancel">Cancel</v-btn>
                            </v-col>
                        </v-row>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </div>
    </v-row>

    <v-table :items="items">
        <thead>
            <tr>
                <th class="text-left">Key</th>
                <th class="text-left">Assigned to</th>
                <th class="text-left">Summary</th>
                <th class="text-left">Description</th>
                <th class="text-left">Status</th>
                <th class="text-left">Due Date</th>
                <th class="text-left">Edit</th>
                <th class="text-left">Delete</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in items" :key="item.id">
                <td>{{ item.key }}</td>
                <td>{{ item.assignee }}</td>
                <td>{{ item.summary }}</td>
                <td>{{ item.description }}</td>
                <td>{{ item.status }}</td>
                <td>{{ item.due_date }}</td>
                <td>
                    <v-btn icon="mdi-pencil" flat @click="editTask(item.id)"></v-btn>
                </td>
                <td>
                    <v-btn icon="mdi-delete" flat @click="deleteTask(item.id)"></v-btn>
                </td>
            </tr>
        </tbody>
    </v-table>
</template>

<script>
    import { defineComponent } from 'vue';
    import Datepicker from 'vue3-datepicker';

    export default defineComponent({
        name: 'HomeView',
        data() {
            return {
                task: {},
                taskDialog: false,
                deleteDialog: false,
                items: [],
                statuses: [],
                users: []
            };
        },
        methods: {
            formatDate(date) {
                const newDate = new Date(date);
                let month = '' + (newDate.getMonth() + 1);
                let day = '' + newDate.getDate();
                const year = newDate.getFullYear();

                if (month.length < 2) month = '0' + month;
                if (day.length < 2) day = '0' + day;

                return [year, month, day].join('-');
            },
            fetchTaks() {
                window
                    .axios({
                        method: 'get',
                        url: 'tasks',
                        params: { active: true }
                    })
                    .then(response => {
                        const { tasks: items, users, statuses } = response.data;
                        this.users = users;
                        this.statuses = statuses;
                        this.items = items;
                    });
            },
            editTask(id) {
                const task = this.items.find(item => item.id == id);
                this.task = Object.assign({}, task);
                this.task.due_date = new Date(task.due_date);
                this.taskDialog = true;
            },
            createTask() {
                this.task = {};
                this.taskDialog = true;
            },
            deleteTask(id) {
                window
                    .axios({
                        method: 'delete',
                        url: `tasks/${id}`
                    })
                    .then(() => {
                        this.taskDialog = false;
                        this.fetchTaks();
                    });
            },
            cancel() {
                this.taskDialog = false;
            },
            saveTask() {
                const { id = null } = this.task;
                let method = 'post';
                let url = 'tasks';

                if (id) {
                    method = 'patch';
                    url += `/${id}`;
                }

                let data = Object.assign({}, this.task);
                if (data.due_date) {
                    console.log(this.formatDate(data.due_date));
                    data.due_date = this.formatDate(data.due_date);
                }

                window
                    .axios({
                        method,
                        url,
                        data
                    })
                    .then(() => {
                        this.taskDialog = false;
                        this.fetchTaks();
                    });
            }
        },
        created() {
            this.fetchTaks();
        },
        components: { Datepicker }
    });
</script>

<style lang="scss">
    .v3dp__input_wrapper {
        border: 1px solid #777;
    }
</style>
