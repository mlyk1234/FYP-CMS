<template> 
    <div class="todoListContainer">
        <v-card class="pa-2">
        <div class="heading">
            <h2 style="margin-left:15px" id="title">Todo List</h2>
            <v-divider></v-divider>
            <add-item-form style="margin-left:25px" v-on:reloadlist="getList()"/>
        </div>
        <v-divider></v-divider>
            <v-card elevation="5" class="pa-2">
                <list-view :items="items" v-on:reloadlist="getList()" />
            </v-card>
        </v-card>
    </div>
</template>

<script>
import addItemForm from "./addItemFormAdmin"
import listView from "./listViewAdmin"

export default {
    components: {
        addItemForm,
        listView
    },
    data: function() {
        return {
            items: []
        }
    },
    methods: {
        getList() {
            axios.get('api/v1/user/items-admin')
            .then( response => {
                this.items = response.data
                console.log(this.items)
            })
            .catch( error => {
                console.log(error);
            })
        }
    },
    created() {
        this.getList();
    }
}
</script>

<style scoped>
.todoListContainer {
    width: 350px;
    margin: auto;
}
.heading {
    background: #e6e6e6;
    padding: 10px;
}
#title {
    text-align: center;
}
