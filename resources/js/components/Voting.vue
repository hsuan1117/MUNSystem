<template>
    <div>
        <li class="list-group-item d-flex justify-content-between align-items-center"
            data-toggle="collapse" :data-target="'#collapse_role_'+vote.id"
        >
            {{ vote.role }} (ID: {{vote.id}})
        </li>
        <div class="collapse " :id="'collapse_role_'+vote.id">
            <div class="btn-group d-flex" v-if="vote.voting === 'Yes'">
                <button type="button" class="RC btn btn-success w-100" @click="onClick($event)">Yes</button>
                <button type="button" class="RC btn btn-default w-100" @click="onClick($event)">No</button>
                <button type="button" class="RC btn btn-default w-100" @click="onClick($event)">Abstain</button>
            </div>
            <div class="btn-group d-flex" v-else-if="vote.voting === 'No'">
                <button type="button" class="RC btn btn-default w-100" @click="onClick($event)">Yes</button>
                <button type="button" class="RC btn btn-danger w-100" @click="onClick($event)">No</button>
                <button type="button" class="RC btn btn-default w-100" @click="onClick($event)">Abstain</button>
            </div>
            <div class="btn-group d-flex" v-else-if="vote.voting === 'Abstain'">
                <button type="button" class="RC btn btn-default w-100" @click="onClick($event)">Yes</button>
                <button type="button" class="RC btn btn-default w-100" @click="onClick($event)">No</button>
                <button type="button" class="RC btn btn-primary w-100" @click="onClick($event)">Abstain</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "voting",
    props: ['endpoint','vote','admin'],
    mounted() {
        this.vote = JSON.parse(this.vote);
        //window.alert(this.amendment.role)
    },
    methods: {
        onClick(e){
            console.log("get")
            var that = this
            axios.post(that.endpoint, {
                'voting': e.currentTarget.innerText,
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
