<template>
  <div v-if="items.links" class="row mt-3">
    <div class="col-sm-12 col-md-5">
      <div class="dataTables_info text-center text-md-left" id="example2_info" role="status" aria-live="polite">Showing {{ (items.current_page - 1) * items.per_page }} to {{ items.to }} of {{ items.total }} entries</div>
    </div>
    <div v-if="items.links.length > 3" class="col-sm-12 col-md-7">
      <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
        <ul class="pagination">
          <li v-for="page in items.links" class="paginate_button page-item" :class="{disabled: !page.url, active: page.active}"><inertia-link :href="page.url" aria-controls="example2" data-dt-idx="0" tabindex="0" class="page-link"><span v-html="page.label"></span></inertia-link></li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'Pagination',
    props: {
      items: Object,
    },
    mounted() {
      //alert(JSON.stringify(this.items))
      this.replaceIcons()
    },
    methods:{
      replaceIcons(){
        const replace = {
          '&laquo; Previous': 'Previous', 
          'Next &raquo;' : 'Next'
        }
        for(let i = 0; i < this.items.links.length; i++){
          if(this.items.links[i].label in replace){
            this.items.links[i].label = replace[this.items.links[i].label]
          }
        }
      }
    }
  }
</script>