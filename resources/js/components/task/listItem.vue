<template>    
    <v-card class="pa-5 d-flex justify-center align-center" elevation="11">
        <input type = "checkbox" @change="updateCheck()" v-model="item.completed"/>
        <span :class="[item.completed ? 'completed' : '', 'itemText']">Chapter {{ item.category_id }}</span>
        <span :class="[item.completed ? 'completed' : '', 'itemText']">{{ item.name }}</span>
        <span :class="[item.completed ? 'completed' : '', 'itemText']"> {{ item.description }}</span>
        <v-btn style="margin-right:10px" color="error" @click="removeItem()">Remove</v-btn>

  
    <v-dialog v-model="dialog" persistent max-width="600px">
      <template v-slot:activator="{ on, attrs }">
        <v-btn color="primary" @click="preset()" dark v-bind="attrs" v-on="on">Edit Task</v-btn>
      </template>
      <v-card>
        <v-card-title>
          <span class="headline">Edit task</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
                <v-text-field v-model="editForm.name" label="Task name" required></v-text-field>
            </v-row>
            <v-row>
                <v-textarea v-model="editForm.description"
                  label="Description (Optional)"
                  hint="Describe about the title of this task (if any)"
                  persistent-hint
                  required
                ></v-textarea>
            </v-row>
            <v-row> 
                <v-select :value="editForm.category"
                  :items="category"
                  label="Category"
                  required
                ></v-select>
            </v-row>
          </v-container>
          <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
          <v-btn color="blue darken-1" text @click="updateTask()">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  
    </v-card>
</template>

<script>
export default {
    props: ['item'],
    data: function () {
        return {
            dialog: false,
            category: ['Chapter 1','Chapter 2','Chapter 3','Chapter 4','Chapter 5','FYP 1', 'FYP 2'],
            editForm: {
                name: '',
                description: '',
                category_id: '',
            },
            updatedForm: {
                name: '',
                description: '',
                category_id: '',
            },
        }
    },
    methods: {
        preset() {
            this.edit = true;
            this.editForm.name = this.item.name;
            this.editForm.description = this.item.description;
            this.editForm.category_id = this.item.category_id;
        },
        updateTask() {
            this.dialog = false;
            this.updatedForm.name = this.editForm.name;
            this.updatedForm.description = this.editForm.description;
            this.updatedForm.category_id = this.editForm.category_id;

            axios.put('api/v1/user/item/form/' + this.item.id, {
                name: this.updatedForm.name,
                description: this.updatedForm.description,
                category_id: this.updatedForm.category_id,
            })
            .then( response => {
                if( response.status ==  200){
                    this.$emit('itemchanged');
                }
            })
            console.log(this.updatedForm);
        },
        updateCheck() {
            axios.put('api/v1/user/item/' + this.item.id, {
                item: this.item
            })
            .then( response => {
                if( response.status == 200){
                    this.$emit('itemchanged');
                }
            })
            .catch(error => {
                console.log(error);
            })
        },
        removeItem() {
            axios.delete('api/v1/user/item/' + this.item.id)
            .then( response => {
                if( response.status == 200){
                    this.$emit('itemchanged');
                }
            })
            .catch( error => {
                console.log(error);
            })
        }
    }
}
</script>

<style scoped>
.completed {
    text-decoration: line-through;
    color: #999999;
}
.itemText {
    width: 100%;
    margin-left: 20px;
}
.item {
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>