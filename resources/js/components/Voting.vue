<template>
    <div>
        <li class="list-group-item d-flex justify-content-between align-items-center"
            data-toggle="collapse" :data-target="'#collapse_role_'+amendment.id"
        >
            {{ amendment.role }} | {{ amendment.title }} (ID: {{amendment.id}})
            <span class="badge badge-success"
                  v-if="amendment.method === 'add'">Add</span>
            <span class="badge badge-primary"
                  v-if="amendment.method === 'modify'">Modify</span>
            <span class="badge badge-danger"
                  v-if="amendment.method === 'strike'">Strike</span>
            <i class="fa fa-check-circle text-success"
               data-toggle="tooltip" data-placement="top" title="Verified Amendment"
               v-if="amendment.accept === 'true'"></i>
            <i class="fa fa-times-circle text-danger"
               data-toggle="tooltip" data-placement="top" title="Rejected Amendment"
               v-else-if="amendment.accept === 'false'"></i>
            <i class="fa fa-question-circle text-info"
               data-toggle="tooltip" data-placement="top" title="Pending Amendment"
               v-else-if="amendment.accept === 'pending'"></i>
        </li>
        <div class="collapse " :id="'collapse_role_'+amendment.id">
            <div class="form-group">
                <textarea class="form-control" rows="3" @change="update($event)" @input="update($event)">{{ amendment.article }}</textarea>
                <div class="btn-group w-100" v-if="admin" role="group">
                    <button type="button" data-status="true" @click="accept($event)" class="btn btn-success">
                        <i class="fa fa-check-circle "
                           data-toggle="tooltip" data-placement="top"
                           title="Verified Amendment"
                        ></i></button>
                    <button type="button" data-status="false" @click="accept($event)" class="btn btn-danger">
                        <i class="fa fa-times-circle "
                           data-toggle="tooltip" data-placement="top"
                           title="Rejected Amendment"
                        ></i></button>
                    <button type="button" data-status="pending" @click="accept($event)" class="btn btn-info">
                        <i class="fa fa-question-circle "
                           data-toggle="tooltip" data-placement="top"
                           title="Pending Amendment"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "amendment",
    props: ['endpoint','accept-endpoint', 'amendment','admin'],
    mounted() {
        this.amendment = JSON.parse(this.amendment);
        //window.alert(this.amendment.role)
    },
    methods: {
        update(e){
            var that = this
            axios.post(that.endpoint, {
                'article': e.currentTarget.value,
                'id': that.amendment.id
            }).then((res) => {
                //console.table(res.data)
                console.log("Saved Update")
                //location.reload()
            }).catch((error) => {
                console.error(error)
            })
        },
        accept(e){
            var that = this
            axios.post(that.acceptEndpoint, {
                'status': e.currentTarget.dataset.status,
                'id': that.amendment.id
            }).then((res) => {
                //console.table(res.data)
                console.log("Saved Update")
                alert(res.data.msg )
                location.reload()
            }).catch((error) => {
                console.error(error)
            })
        }
    }
}
</script>
