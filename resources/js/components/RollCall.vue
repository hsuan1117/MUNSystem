<template>
    <div class="btn-group d-flex" v-if="status === 'A'">
        <button type="button" class="RC btn btn-default w-100" @click="onClick($event)">P</button>
        <button type="button" class="RC btn btn-default w-100" @click="onClick($event)">PV</button>
        <button type="button" class="RC btn btn-danger w-100" @click="onClick($event)">A</button>
    </div>
    <div class="btn-group d-flex" v-else-if="status === 'PV'">
        <button type="button" class="RC btn btn-default w-100" @click="onClick($event)">P</button>
        <button type="button" class="RC btn btn-success w-100" @click="onClick($event)">PV</button>
        <button type="button" class="RC btn btn-default w-100" @click="onClick($event)">A</button>
    </div>
    <div class="btn-group d-flex" v-else-if="status === 'P'">
        <button type="button" class="RC btn btn-primary w-100" @click="onClick($event)">P</button>
        <button type="button" class="RC btn btn-default w-100" @click="onClick($event)">PV</button>
        <button type="button" class="RC btn btn-default w-100" @click="onClick($event)">A</button>
    </div>
</template>

<script>
export default {
    name: "roll-call",
    props: ['endpoint', 'role', 'status'],
    mounted() {

    },
    methods: {
        onClick(e) {
            console.log("get")
            var that = this
            axios.post(that.endpoint, {
                'status': e.currentTarget.innerText,
                'role': that.role
            }).then((res) => {
                console.table(res.data)
                location.reload()
            }).catch((error) => {
                console.error(error)
            })
        }
    }
}
</script>
