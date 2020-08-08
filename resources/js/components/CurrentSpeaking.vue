<template>
    <div>NOW Speaking: <b>{{role}}</b></div>
</template>

<script>
export default {
    name: "current-speaking",
    props: ['endpoint'],
    mounted() {
        this.getRole()
        setInterval(this.getRole,1000)
    },
    data(){
      return {
          "role":"Loading ..."
      }
    },
    methods: {
        getRole(){
            let self = this;
            axios.get(self.endpoint).then((res) => {
                self.role = res.data.role || ""
            }).catch((error) => {
                console.error(error)
            })
        }
    }
}
</script>
