<template>
  <admin-layout>
    <template #header>
      <h1 class="m-0">Permission</h1>
    </template>
    
    <Content>
      <Table />
      <!--
        <div class="row">
          <div class="col-12">
            <Card :isTable="true" varient="light">
              <template #title>Permission</template>
              <template #title_right>
                <Button class="mr-2" type="button" varient="dark" @click="showModal(null)">Create Permission</Button>
              </template>
              
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Group</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(permission, index) in permissions.data">
                    <td>{{ index + 1 }}</td>
                    <td>{{ permission.name }}</td>
                    <td>{{ permission.group_name }}</td>
                    <td>
                      <Button varient="danger" type="button" :isLoading="loadingPermissionDeleteButton" @click="deletePermission(permission.delete_url)">
                        Delete
                      </Button>
                      <Button class="ml-2" type="button" @click="showModal(permission)">
                        Edit
                      </Button>
                    </td>
                  </tr>
                </tbody>
              </table>
              
            </Card>
          </div>
        </div>
      -->
    </Content>
    
    <Modal id="gate_permission_create_modal" :title="modalTitle" varient="teal">
       <template #body>
        <form @submit.prevent="submitPermission" novalidate="novalidate">
                       <div class="form-group">
              <label for="name_field">Name</label>
              <input v-model="form.name" :disabled="form.processing" type="text" name="name" class="form-control" :class="{'is-invalid': form.errors.name}" id="name_field" placeholder="Permission name" >
              <span class="error invalid-feedback">{{ form.errors.name }}</span>
            </div>
            <div class="form-group">
              <label for="group_name_field">Group Name</label>
              <input v-model="form.group_name" :disabled="form.processing" type="text" name="group_name" class="form-control" :class="{'is-invalid': form.errors.group_name}" id="group_name_field" placeholder="Permission group name" >
              <span class="error invalid-feedback">{{ form.errors.group_name }}</span>
            </div>
            <div class="form-group">
              <label for="guard_name_field">Guard Name</label>
              <input v-model="form.guard_name" :disabled="form.processing" type="text" name="guard_name" class="form-control" :class="{'is-invalid': form.errors.guard_name}" id="guard_name_field" placeholder="Permission guard name" >
              <span class="error invalid-feedback">{{ form.errors.guard_name }}</span>
            </div>
        </form>
       </template>
       
       <template #action>
         <Button :isLoading="form.processing" @click="submitPermission"></Button>
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
  import Table from '@/Components/Table.vue'
  import { Inertia } from '@inertiajs/inertia'
  import { useForm } from '@inertiajs/inertia-vue3'
  
  export default {
    name: 'Permission',
    components: {
        AdminLayout, Modal, Content, Card, Button, Table
    },
    props: {
      permissions: Object,
    },
    data() {
      return {
        form: useForm({
          name: null,
          group_name: null,
          guard_name: null,
        }),
        modal: null,
        modalTitle: null,
        isEditing: false,
        editUrl: null,
        loadingPermissionDeleteButton: false,
      }
    },
    mounted(){
      let el = document.querySelector('#gate_permission_create_modal')
      this.modal = new bootstrap.Modal(el)
    },
    methods: {
      showModal(data = null){
        this.isEditing = (data !== null)
        this.modalTitle = (data == null) ? 'Create permission' : 'Update permission'
        this.form.clearErrors()
        if(this.isEditing){
          this.editUrl = data.edit_url;
          this.form.name = data.name;
          this.form.group_name = data.group_name;
          this.form.guard_name = data.guard_name;
        }else{
          this.form.reset()
        }
        this.modal.show()
      },
      submitPermission(){
        this.form.clearErrors()
        var url = this.isEditing ? this.editUrl : route('gate.permission.store');
        this.form.post(url, {
          preserveScroll: true,
          onSuccess: () => {
            this.form.reset()
            this.modal.hide();
          }
        });
      },
      deletePermission(url){
        Inertia.delete(url, {
          onBefore: () => {
            this.loadingPermissionDeleteButton = true
          },
          onFinish: finish => {
            this.loadingPermissionDeleteButton = false;
          }
        })
      }
    },
    
  }
</script>
