<template>
  <div>
    <v-card>
      <v-responsive :aspect-ratio="16/9">

        
        <v-card-text> 
        <h3>Report Submission</h3>
            <v-select
            v-model="select"
            :items="items"
            item-text="chapter"
            label="Select"
            persistent-hint
            return-object
            single-line
            @input="onChange"
            ></v-select>
        </v-card-text>
        
            <div v-for="preset in presets">
            <v-card-text> {{preset.submission_title}}
            <v-card class="mx-auto" max-width="auto" outlined>
                <v-list-item>
                    <v-list-item-title class="headline mb-1">{{ select }}</v-list-item-title>
                </v-list-item>
                <v-card-text>
                    <v-file-input label="File input" v-model="file" v-if="edit"></v-file-input>
                    <v-file-input :label="preset.submission_title" disabled v-else></v-file-input>
                </v-card-text>
                <v-card-actions>
                        <v-btn outlined rounded text @click="upload" v-if="edit">Upload</v-btn>
                        <a v-else div v-for="key in presets" v-bind:href="'../storage/uploads/'+key.userid+'/'+select+'/'+key.submission_title" download="">
                            <v-btn outlined rounded text>Download</v-btn>
                        </a>
                        <v-btn outlined rounded text @click="resubmit">Re-Submit</v-btn>
                </v-card-actions>
                <v-card-text>
                <v-text-field value="No Remarks" label="Supervisor" outlined readonly></v-text-field>
                <v-text-field value="No Remarks" label="Examiner" outlined readonly></v-text-field>
                </v-card-text>
            </v-card>
            </v-card-text>
            </div>
      </v-responsive>
    </v-card>
  </div>
</template>

<script>
    const index = 0;
    export default {
        
        data() {
            return { 
                edit: false,
                select: '',
                items: ['Chapter 1','Chapter 2','Chapter 3','Chapter 4','Chapter 5'],
                file: '',
                success: '',
                download: [],
                filename: '',
                presets: [],
                search: [],
                editForm: {
                    submission_title: '',
                    file_path: '',
                },

            }
        },        
        methods: {
            onChange : function(select){
                let search = this.select
                console.log(search);
                axios.get('/api/v1/user/search/' + search)
                .then((response) => {
                    this.search = response.data
                    console.log(response.data)
                })
            },
            resubmit() {
                this.edit = true;
            },
            upload() {
                this.edit = false;
                let existingObj = this;

                const config = {
                    headers: {
                        'content-type' : 'multipart/form-data'
                    }
                }

                let data = new FormData();
                data.append('c', this.select);
                data.append('file', this.file);
                
                axios.post('/api/v1/user/upload',data, config)
                .then(function (res) {
                    existingObj.success = res.data.success;
                })
                .catch(function (err) {
                    existingObj.output = err;
                });
            },
            downloads() {
                axios.get('/api/v1/user/download', {responseType: 'blob'})
                .then((response) => {
                
                    //var fileUrl = window.URL.createObjectURL(new Blob([response.data]));
                    this.loops = response.data;
                    var fileLink = document.createElement('a')
                    fileLink.href = fileUrl;

                    fileLink.setAttribute('download', fileUrl )
                    document.body.appendChild(fileLink)

                    fileLink.click()
                });
            }
        },

        created() {
            axios.get('/api/v1/user/download')
            .then(response => ( this.presets = response.data ) )
        },

    }
</script>