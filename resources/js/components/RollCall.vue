<template>
    <div class="btn-group d-flex">
        <div v-if="status == 'P'">
            <button type="button" class="RC btn btn-primary w-100">P</button>
            <button type="button" class="RC btn btn-default w-100">PV</button>
            <button type="button" class="RC btn btn-default w-100">A</button>
        </div>
        <div v-if="status == 'A'">
            <button type="button" class="RC btn btn-default w-100">P</button>
            <button type="button" class="RC btn btn-default w-100">PV</button>
            <button type="button" class="RC btn btn-danger w-100">A</button>
        </div>
        <div v-if="status == 'PV'">
            <button type="button" class="RC btn btn-default w-100">P</button>
            <button type="button" class="RC btn btn-success w-100">PV</button>
            <button type="button" class="RC btn btn-default w-100">A</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "roll-call",
    props: ['endpoint', 'role', 'status'],
    mounted() {
        console.log('Component mounted.')
    }
}
</script>
