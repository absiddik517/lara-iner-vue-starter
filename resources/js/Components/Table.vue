<template>
  <div class="table-container">
    <div class="px-3 py-3 d-flex justify-content-between align-items-center bb-1">
      <div class="flex-1 table-title">
        Posts
      </div>
      <div class="flex-1 d-flex justify-content-end">
        <Button>Create</Button>
      </div>
    </div>
    
    <div class="d-flex bb-1 justify-content-between align-items-center py-3 px-2">
      <div class="flex-1">
        <input type="text" class="form-control" placeholder="Search ...">
      </div>
      <div class="flex-1 text-right">
        <Button class="mr-2"><i class="fa fa-filter"></i> Filter</Button> 
        <Button><i class="fa fa-eye"></i></Button>
      </div>
    </div>
    
    <div class="px-2 py-3 row mx-0 gy-2">
      <button v-for="index in 3" class="filter-item" style="width: fit-content">
        Siddik <i class="ml-2 fa fa-times"></i>
      </button>
    </div>
    
    <div class="mt-4">
      <div class="table-responsive" style="height: 550px;">
        <table class="table table-border table-head-fixed text-nowrap">
          <thead style="background: #c1c2c7">
            <tr class="table-head-style">
              <th width="5"></th>
              <th>Name</th>
              <th>Address</th>
              <th>Name</th>
              <th>Name</th>
              <th>Name</th>
              <th>Name</th>
              <th>Address</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="index in 10">
              <td><input type="checkbox"></td>
              <td>Siddik Mymensing {{ index }}</td>
              <td>Siddik {{ index }}</td>
              <td>Siddik {{ index }}</td>
              <td>Siddik {{ index }}</td>
              <td>Siddik {{ index }}</td>
              <td>Siddik {{ index }}</td>
              <td>Baruajani {{ index }}</td>
              <td>:</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="px-2 py-3">
        pagination svv
      </div>
    </div>
  </div>
</template>

<script setup>
import Button from '@/Components/Button.vue'
  
</script>

<style scoped>
  .table-container{
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    margin-bottom: 15px;
    box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
  }
  
  .table-responsive t{
    background: red!important;
    background-color: red!important;
  }
  
  .table-title{
    font-size: 24px;
    font-weight: bold;
  }
  
  .bb-1 {
    border-bottom-width: 1px;
    border-bottom-style: solid;
    border-bottom-color: #C0C0C0;
  }
  .bt-1 {
    border-top-width: 1px;
    border-top-style: solid;
    border-top-color: #C0C0C0;
  }
  
  .border-tb{
    border-top: 1px solid #C0C0C0;
    border-bottom: 1px solid #C0C0C0;
  }
  
  .filter-item{
    border-radius: 25px;
    padding: 10px 18px;
    margin-right: 8px;
    outline: 0;
    border: 0;
    background: #AEE9AA;
    color: #075C2F;
    font-weight: 600;
    transition: all .3s;
  }
  
  .filter-item:hover{
    background: #E8A7A0;
    color: #700E03;
  }
  
  
  
</style>