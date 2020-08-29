<template>
    <div>
        <li class="list-group-item  d-flex justify-content-between align-items-center"
            data-toggle="collapse" :data-target="'#collapse_role_'+vote.id"
        >
            {{ vote.role }} (ID: {{vote.id}})
        </li>
        <div class="collapse show" :id="'collapse_role_'+vote.id">
            <div class="btn-group d-flex" v-if="vote.voting === 'Yes'">
                <button type="button" class="RC btn btn-success w-100" @click="onClick($event)">Yes</button>
                <button type="button" class="RC btn btn-outline-secondary w-100" @click="onClick($event)">No</button>
                <button type="button" class="RC btn btn-outline-secondary w-100" @click="onClick($event)">Abstain</button>
            </div>
            <div class="btn-group d-flex" v-else-if="vote.voting === 'No'">
                <button type="button" class="RC btn btn-outline-secondary w-100" @click="onClick($event)">Yes</button>
                <button type="button" class="RC btn btn-danger w-100" @click="onClick($event)">No</button>
                <button type="button" class="RC btn btn-outline-secondary w-100" @click="onClick($event)">Abstain</button>
            </div>
            <div class="btn-group d-flex" v-else-if="vote.voting === 'Abstain'">
                <button type="button" class="RC btn btn-outline-secondary w-100" @click="onClick($event)">Yes</button>
                <button type="button" class="RC btn btn-outline-secondary w-100" @click="onClick($event)">No</button>
                <button type="button" class="RC btn btn-primary w-100" @click="onClick($event)">Abstain</button>
            </div>
        </div>
    </div>
</template>

<script>
import Swal from 'sweetalert2'
import 'sweetalert2/src/sweetalert2.scss'
export default {
    name: "voting",
    props: ['endpoint','vote','admin','id'],
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
                //'vote_id':that.id,
                'role': that.vote.role,
                'id':that.vote.id
            }).then((res) => {
                if(res.data.status === "fail"){
                    switch (res.data.msg){
                        case 'permission/denied':
                            Swal.fire({
                                title: 'Error!',
                                text: "Vote fail, you don't have permission.",
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            })
                            break;
                        default:
                            Swal.fire({
                                title: 'Error!',
                                text: "Vote Fail, unknown issue.",
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            })
                    }
                }else{
                    Swal.fire({
                        title: 'Success!',
                        text: "Vote success.",
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    }).then(()=>{
                        location.reload()
                    })
                }
            }).catch((error) => {
                console.error(error)
            })
        }
    }
}
</script>
