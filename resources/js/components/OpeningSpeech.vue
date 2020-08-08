<template>
    <div class="form-group">
        <textarea class="form-control" rows="3" @change="onUpdate($event)" @input="onInput($event)">{{ article }}</textarea>
        <button class="form-control btn btn-primary" @click="startSpeech($event)" >Start Speech</button>
    </div>
</template>

<script>
export default {
    name: "opening-speech",
    props: ['endpoint', 'role', 'article','start-endpoint'],
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
        },
        startSpeech(e) {
            var that = this
            e.currentTarget.disabled = true;
            axios.post(that.startEndpoint, {
                'role': that.role
            }).then((res) => {
                if(res.data.status === "fail")alert("No")
                window.setTimeout(()=>{
                    location.reload()
                },3000)
            }).catch((error) => {
                console.error(error)
            })
        }
    }
}
</script>
