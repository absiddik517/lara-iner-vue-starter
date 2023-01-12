<template>
  <admin-layout>
    <template #header>
      <h1 class="m-0">Permission</h1>
    </template>
    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card" style="overflow: hidden;">
              <div class="card-header">
                <h3 class="card-title">
                Permission
                </h3>
                <div class="card-tools">
                  <button @click="showModal(null)" class="btn btn-info mr-3">Add permission</button>
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(permission, index) in permissions.data">
                      <td>{{ index + 1 }}</td>
                      <td>{{ permission.name }}</td>
                      <td>
                        <button class="btn btn-danger" :disabled="loadingRoleDeleteButton" @click="deleteRole(role.delete_url)">
                          Delete
                        </button>
                        <button class="btn btn-danger ml-3" :disabled="loadingRoleEditButton" @click="showModal(role)">
                          Edit
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <Modal id="exampleModal" :title="modalTitle">
         <template #body>
          <form @submit.prevent="submit" novalidate="novalidate">
             <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input v-model="form.name" :disabled="form.processing" type="text" name="name" class="form-control" :class="{'is-invalid': form.errors.name}" id="exampleInputEmail1" placeholder="Role name" aria-describedby="exampleInputEmail1-error" aria-invalid="true">
                <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ form.errors.name }}</span>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Guard name</label>
                <input v-model="form.guard_name" :disabled="form.processing || !form.name" type="text" name="guard_name" class="form-control" :class="{'is-invalid': form.errors.guard_name}" id="exampleInputEmail1" placeholder="Role name" aria-describedby="exampleInputEmail1-error" aria-invalid="true">
                <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ form.errors.guard_name }}</span>
              </div>
          </form>
         </template>
         
         <template #action>
            <button @click="submit" :disabled="form.processing" type="button" class="btn btn-danger">
              Submit <Spinner :show="form.processing" />
            </button>
         </template> 
      </Modal>
      
    </section>
  </admin-layout>
</template>


<script>
  import AdminLayout from '@/Layouts/AdminLayout'
  import Spinner from '@/Kit/Spinner'
  import Modal from '@/Components/Modal.vue'
  import { Inertia } from '@inertiajs/inertia'
  import { useForm } from '@inertiajs/inertia-vue3'
  import { onMounted, getCurrentInstance, ref } from "vue";
  
  export default {
    name: 'Permission',
    components: {
        AdminLayout,
        Spinner, Modal
    },
    props: {
      permissions: Object,
    },
    data() {
      return {
        form: useForm({
          name: null,
          guard_name: 'web'
        }),
        modal: null,
        modalTitle: null,
        isEditing: false,
        editUrl: null,
        loadingRoleDeleteButton: false,
        loadingRoleEditButton: false,
      }
    },
    mounted(){
      let el = document.querySelector('#exampleModal')
      this.modal = new bootstrap.Modal(el)
    },
    methods: {
      showModal(data = null){
        this.isEditing = (data !== null)
        this.modalTitle = (data == null) ? 'Create Role' : 'Update role'
        this.form.clearErrors()
        if(this.isEditing){
          this.editUrl = data.edit_url
          this.form.name = data.name
          this.form.guard_name = data.guard_name
        }else{
          this.form.reset('name', 'guard_name')
        }
        this.modal.show()
      },
      submit(){
        this.form.clearErrors()
        var url = this.isEditing ? this.editUrl : route('admin.gate.role.store');
        this.form.post(url, {
          preserveScroll: true,
          onSuccess: () => {
            this.form.reset('name', 'guard_name')
            this.modal.hide();
          }
        });
      },
      update(){
        this.form.clearErrors()
        this.form.post(this.editUrl, {
          preserveScroll: true,
          onSuccess: () => {
            this.form.reset('name', 'guard_name')
            this.modal.hide();
          }
        });
      },
      deleteRole(url){
        Inertia.delete(url, {
          onBefore: () => {
            this.loadingRoleDeleteButton = true
          },
          onFinish: finish => {
            this.loadingRoleDeleteButton = false;
          }
        })
      }
    },
    
  }
</script>
