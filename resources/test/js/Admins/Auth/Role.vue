<template>
  <admin-layout>
    <template #header>
      <h1 class="m-0">Role</h1>
    </template>
    
    <Content>
        <div class="row">
          <div class="col-12">
            <Card :isTable="true" varient="dark">
              <template #title>Role</template>
              <template #title_right>
                <Button class="mr-2" type="button" varient="light" @click="showModal(null)">Create Role</Button>
              </template>
              
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                                        <th>Name</th>
                    <th>Website</th>
                    <th>Email</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(role, index) in roles.data">
                    <td>{{ index + 1 }}</td>
                                        <td>{{ role.name }}</td>
                    <td>{{ role.website }}</td>
                    <td>{{ role.email }}</td>
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
    
    <Modal id="admins_auth_role_create_modal" :title="modalTitle" varient="teal">
       <template #body>
        <form @submit.prevent="submitRole" novalidate="novalidate">
                       <div class="form-group">
              <label for="name_field">Name</label>
              <input v-model="form.name" :disabled="form.processing" type="text" name="name" class="form-control" :class="{'is-invalid': form.errors.name}" id="name_field" placeholder="Role name" >
              <span class="error invalid-feedback">{{ form.errors.name }}</span>
            </div>
            <div class="form-group">
              <label for="website_field">Website</label>
              <input v-model="form.website" :disabled="form.processing" type="text" name="website" class="form-control" :class="{'is-invalid': form.errors.website}" id="website_field" placeholder="Role website" >
              <span class="error invalid-feedback">{{ form.errors.website }}</span>
            </div>
            <div class="form-group">
              <label for="email_field">Email</label>
              <input v-model="form.email" :disabled="form.processing" type="text" name="email" class="form-control" :class="{'is-invalid': form.errors.email}" id="email_field" placeholder="Role email" >
              <span class="error invalid-feedback">{{ form.errors.email }}</span>
            </div>
        </form>
       </template>
       
       <template #action>
         <Button :isLoading="form.processing" @click="submitRole"></Button>
       </template> 
    </Modal>
  </admin-layout>
</template>


<script>
  import AdminLayout from '@/Layouts/AdminLayout'
  import Modal from '@/Components/Modal.vue'
  import Card from '@/Components/Card.vue'
  import Button from '@/Components/Button.vue'
  import Content from '@/Components/Content.vue'
  import { Inertia } from '@inertiajs/inertia'
  import { useForm } from '@inertiajs/inertia-vue3'
  
  export default {
    name: 'Role',
    components: {
        AdminLayout, Modal, Content, Card, Button,
    },
    props: {
      roles: Object,
    },
    data() {
      return {
        form: useForm({
                    name: null,
          website: null,
          email: null,
        }),
        modal: null,
        modalTitle: null,
        isEditing: false,
        editUrl: null,
        loadingRoleDeleteButton: false,
      }
    },
    mounted(){
      let el = document.querySelector('#admins_auth_role_create_modal')
      this.modal = new bootstrap.Modal(el)
    },
    methods: {
      showModal(data = null){
        this.isEditing = (data !== null)
        this.modalTitle = (data == null) ? 'Create role' : 'Update role'
        this.form.clearErrors()
        if(this.isEditing){
          this.editUrl = data.edit_url;
                    this.form.name = data.name;
          this.form.website = data.website;
          this.form.email = data.email;
        }else{
          this.form.reset()
        }
        this.modal.show()
      },
      submitRole(){
        this.form.clearErrors()
        var url = this.isEditing ? this.editUrl : route('auth.role.store');
        this.form.post(url, {
          preserveScroll: true,
          onSuccess: () => {
            this.form.reset()
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
