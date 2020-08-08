<template>
    <div>NOW Step: <b>{{step}}</b></div>
</template>

<script>
export default {
    name: "current-step",
    props: ['endpoint'],
    mounted() {
        this.getStep()
        setInterval(this.getStep,1000)
    },
    data(){
      return {
          "step":"Loading ..."
      }
    },
    methods: {
        getStep(){
            let self = this;
            axios.get(self.endpoint).then((res) => {
                console.table(res.data)
                self.step = res.data.step || ""
            }).catch((error) => {
                console.error(error)
            })
        }
    }
}
</script>
