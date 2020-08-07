<template>
    <div class="form-group">
        <textarea class="form-control" rows="3" @change="onUpdate($event)" @input="onInput($event)">{{ article }}</textarea>
    </div>
</template>

<script>
export default {
    name: "opening-speech",
    props: ['endpoint', 'role', 'article'],
    mounted() {

    },
    methods: {
        onUpdate(e) {
            //console.log("get")
            var that = this
            axios.post(that.endpoint, {
                'article': e.currentTarget.value,
                'role': that.role
            }).then((res) => {
                //console.table(res.data)
                console.log("Saved Update")
                //location.reload()
            }).catch((error) => {
                console.error(error)
            })
        },
        onInput(e) {
            console.log("get")
            var that = this
            axios.post(that.endpoint, {
                'article': e.currentTarget.value,
                'role': that.role
            }).then((res) => {
                console.table(res.data)
                //location.reload()
            }).catch((error) => {
                console.error(error)
            })
        }
    }
}
</script>
