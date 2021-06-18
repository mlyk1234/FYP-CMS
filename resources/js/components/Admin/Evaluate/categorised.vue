<template>
<div>
    <supervised></supervised>
    <v-divider></v-divider>
    <examined></examined>
</div>

</template>

<script>
import Supervised from "./Supervised/list.vue"
import Examined from "./Examined/list.vue"
export default {
    components: {
        Supervised,
        Examined,
    }
}
</script>