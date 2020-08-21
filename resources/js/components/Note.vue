<template>
    <div>
        <li class="list-group-item d-flex justify-content-between align-items-center"
            data-toggle="collapse" :data-target="'#collapse_role_'+note.id"
        >
            {{ note.role }} | {{ note.title }} (ID: {{note.id}})
            <span class="badge badge-secondary">{{note.recipient}}</span>

            <i class="fa fa-check-circle text-success"
               data-toggle="tooltip" data-placement="top" title="Verified Note"
               v-if="note.accept === 'true'"></i>
            <i class="fa fa-times-circle text-danger"
               data-toggle="tooltip" data-placement="top" title="Rejected Note"
               v-else-if="note.accept === 'false'"></i>
            <i class="fa fa-question-circle text-info"
               data-toggle="tooltip" data-placement="top" title="Pending Note"
               v-else-if="note.accept === 'pending'"></i>
        </li>
        <div class="collapse " :id="'collapse_role_'+note.id">
            <div class="form-group">
                <textarea class="form-control" rows="3" @change="update($event)" @input="update($event)">{{ note.article }}</textarea>
                <div class="btn-group w-100" v-if="admin" role="group">
                    <button type="button" data-status="true" @click="accept($event)" class="btn btn-success">
                        <i class="fa fa-check-circle "
                           data-toggle="tooltip" data-placement="top"
                           title="Verified Note"
                        ></i></button>
                    <button type="button" data-status="false" @click="accept($event)" class="btn btn-danger">
                        <i class="fa fa-times-circle "
                           data-toggle="tooltip" data-placement="top"
                           title="Rejected Note"
                        ></i></button>
                    <button type="button" data-status="pending" @click="accept($event)" class="btn btn-info">
                        <i class="fa fa-question-circle "
                           data-toggle="tooltip" data-placement="top"
                           title="Pending Note"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "amendment",
    props: ['endpoint','accept-endpoint', 'note','admin'],
    mounted() {
        this.note = JSON.parse(this.note);
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
