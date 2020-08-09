<template>
    <div>
        NOW Speaking: <b>{{role}}</b>
        <count-down :deadline="start"></count-down>
    </div>
</template>

<script>
// TODO: import count-down in CurrentSpeaking
import CountDown from "./CountDown";
export default {
    name: "current-speaking",
    props: ['endpoint'],
    mounted() {
        this.getRole()
        setInterval(this.getRole,1000)
    },
    data(){
      return {
          "role":"Loading ...",
          "start":""
      }
    },
    methods: {
        getRole(){
            let self = this;
            axios.get(self.endpoint).then((res) => {
                self.role = res.data.role || ""
                let start = new Date((Date.parse(res.data.start)+60000)).toISOString()
                self.start = start || ""
            }).catch((error) => {
                console.error(error)
            })
        }
    }
}
</script>
