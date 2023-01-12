<template>
  <admin-layout>
    <template #header>
      <h1 class="m-0">Roles</h1>
    </template>
    
    <Content>
        <div class="row">
          <div class="col-12">
            <Card :isTable="true" varient="dark">
              <template #title>Roles</template>
              <template #title_right>
                <Button class="mr-2" type="button" varient="light" @click="showModal(null)">Create</Button>
              </template>
              
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Guard</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(role, index) in roles.data">
                    <td>{{ index + 1 }}</td>
                    <td>{{ role.name }}</td>
                    <td>{{ role.guard_name }}</td>
                    <td>
                      <Button type="button" :isLoading="loadingRoleDeleteButton" @click="deleteRole(role.delete_url)">
                        Delete
                      </Button>
                      <Button class="ml-2" type="button" @click="showModal(role)">
                        Edit
                      </Button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </Card>
          </div>
        </div>
    </Content>
    <Modal id="exampleModal" :title="modalTitle" varient="teal">
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
         <Button :isLoading="form.processing" @click="submit"></Button>
       </template> 
    </Modal>
  </admin-layout>
</template>


<script>
  import AdminLayout from '@/Layouts/AdminLayout'
  import Spinner from '@/Kit/Spinner'
  import Modal from '@/Components/Modal.vue'
  import Card from '@/Components/Card.vue'
  import Button from '@/Components/Button.vue'
  import Content from '@/Components/Content.vue'
  import { Inertia } from '@inertiajs/inertia'
  import { useForm } from '@inertiajs/inertia-vue3'
  import { onMounted, getCurrentInstance, ref } from "vue";
  
  export default {
    name: 'Roles',
    components: {
        AdminLayout,
        Spinner, Modal, Content, Card, Button,
    },
    props: {
      roles: Object,
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
