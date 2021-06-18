<template>
  <div>
    <v-card>
      <v-responsive :aspect-ratio="16/9">
        <v-card-text>
          <h3>Report Submission</h3>
          <div>

            <v-expansion-panels>
            <v-expansion-panel>
                <v-expansion-panel-header>
                Chapter 1
                <template v-slot:actions>
                    <v-icon color="primary">
                    $expand
                    </v-icon>
                </template>
                <v-expansion-panel-content>
                <v-file-input
                    v-model="files"
                    placeholder="Upload your documents"
                    label="File input"
                    multiple
                    prepend-icon="mdi-paperclip"
                >
                    <template v-slot:selection="{ text }">
                    <v-chip
                        small
                        label
                        color="primary"
                    >
                        {{ text }}
                    </v-chip>
                    </template>
                </v-file-input>
                </v-expansion-panel-content>
                </v-expansion-panel-header>
                <v-expansion-panel-content>
                <v-text-field
                    value="Remarks"
                    label="Supervisor"
                    outlined
                    readonly
                ></v-text-field>
                </v-expansion-panel-content>
                <v-expansion-panel-content>
                <v-text-field
                    value="Remarks"
                    label="Examiner"
                    outlined
                    readonly
                ></v-text-field>                
            </v-expansion-panel-content>
            </v-expansion-panel>

            <v-expansion-panel>
                <v-expansion-panel-header disable-icon-rotate>
                Chapter 2
                <template v-slot:actions>
                    <v-icon color="teal">
                    mdi-check
                    </v-icon>
                </template>
                </v-expansion-panel-header>
                <v-expansion-panel-content>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </v-expansion-panel-content>
            </v-expansion-panel>

            <v-expansion-panel>
                <v-expansion-panel-header disable-icon-rotate>
                Chapter 3
                <template v-slot:actions>
                    <v-icon color="error">
                    mdi-alert-circle
                    </v-icon>
                </template>
                </v-expansion-panel-header>
                <v-expansion-panel-content>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </v-expansion-panel-content>
            </v-expansion-panel>

            <v-expansion-panel>
                <v-expansion-panel-header disable-icon-rotate>
                Chapter 4
                <template v-slot:actions>
                    <v-icon color="error">
                    mdi-alert-circle
                    </v-icon>
                </template>
                </v-expansion-panel-header>
                <v-expansion-panel-content>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </v-expansion-panel-content>
            </v-expansion-panel>

            <v-expansion-panel>
                <v-expansion-panel-header disable-icon-rotate>
                Chapter 5
                <template v-slot:actions>
                    <v-icon color="error">
                    mdi-alert-circle
                    </v-icon>
                </template>
                </v-expansion-panel-header>
                <v-expansion-panel-content>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </v-expansion-panel-content>
            </v-expansion-panel>

            <v-expansion-panel>
                <v-expansion-panel-header disable-icon-rotate>
                Chapter 6
                <template v-slot:actions>
                    <v-icon color="error">
                    mdi-alert-circle
                    </v-icon>
                </template>
                </v-expansion-panel-header>
                <v-expansion-panel-content>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </v-expansion-panel-content>
            </v-expansion-panel>

            </v-expansion-panels>
        </div>
        </v-card-text>
      </v-responsive>
    </v-card>
  </div>
</template>

<script> 
    export default {

    }
</script>