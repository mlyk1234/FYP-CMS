<template>
<div>
    <!--
    <div class="addItem">
        <input type="text" v-model="item.name" />
        <v-btn @click="addItem()"  success>Click</v-btn>
    </div>
    -->
  <v-row>
    <v-dialog v-model="dialog" persistent max-width="600px">
      <template v-slot:activator="{ on, attrs }">
        <v-btn color="primary" dark v-bind="attrs" v-on="on">Add Task</v-btn>
      </template>
      <v-card>
        <v-card-title>
          <span class="headline">New task</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
                <v-text-field v-model="item.name" label="Task name" required></v-text-field>
            </v-row>
            <v-row>
                <v-textarea v-model="item.description"
                  label="Description (Optional)"
                  hint="Describe about the title of this task (if any)"
                  persistent-hint
                  required
                ></v-textarea>
            </v-row>
            <v-row> 
                <v-select v-model="item.category_id"
                  :items="category"
                  item-text="val"
                  item-value="id"
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
          <v-btn color="blue darken-1" text @click="enter()">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</div>
</template>

<script> 
    export default {
        data: function () {
            return {
                
                item: { 
                    name: "",
                    description: "",
                    category_id: "",
                },
                dialog: false,
                category: [{id:'1', val:'Chapter 1'}, {id:'2', val:'Chapter 2'}, {id:'3', val:'Chapter 3'}, {id:'4', val:'Chapter 4'}],
            }
        },
        methods: {
            enter() {
                //console.log(this.itemz);
                this.dialog = false;
                axios.post('api/v1/user/item/store', {
                    item: this.item.name,
                    description: this.item.description,
                    category_id: this.item.category_id,
                })
                .then( response => {
                    if( response.status == 201 ) {
                        this.item.name = "";
                        this.$emit('reloadlist');
                    }
                })
                .catch( error => {
                    console.log (error );
                })
            },
            addItem() {
                if( this.item.name == '') {
                    return;
                }

                axios.post('api/v1/user/item/store', {
                    item: this.item
                })
                .then( response => {
                    if( response.status == 201 ) {
                        this.item.name = "";
                        this.$emit('reloadlist');
                    }
                })
                .catch( error => {
                    console.log (error );
                })
            }
        }
    }
</script>

<style scoped>
.plus {
    font-size: 20px;
}
.active {
    color: #00CE25;
}
.inactive {
    color: #999999;
}
</style>