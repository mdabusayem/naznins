 <template>
    <div >
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Today Order</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row card container">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Today Orders Table
           
          </div>
          <div class="card-body" >
            <div class="card-body">
              <div class="table-responsive">
                <label>Search Here</label>
               <input type="text" v-model="searchTerm" class="form-control" style="width:200px; "><br>
                <table class="table table-bordered" id="" width="100%" cellspacing="0">

                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Sub Total Amount</th>
                      <th>Pay</th>
                      <th>Due</th>
                      <th>PayBy</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                
                  <tbody>

                    <tr v-for="order in filtersearch" :key="order.id">
                      <td>{{ order.name }}</td>
                      <td>{{ order.sub_total }}</td>
                      <td>{{ order.pay }}</td>
                      <td>{{ order.due }}</td>

                      <td>{{ order.payby }}</td>
                      <td>{{ order.status }}</td>
                      <td>
                        <router-link :to="{name: 'view-order', params:{id: order.id} }" class="btn btn-sm btn-info">view</router-link>
                        <button v-if="order.status=='pending'" @click.prevent="statuschange(order.id)" class="btn btn-sm btn-danger">Delivered?</button>
                        <router-link :to="{name: 'invoiceprint', params:{id: order.id} }" class="btn btn-sm btn-success">Invoice</router-link>

                        
                      </td>
                    </tr> 
        
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted" id="non-printable">

              
            </div>
          </div>
       </div>
   </div>
</template>

<script>

    export default {
    	mounted(){
            if (!User.loggedIn()) {
               this.$router.push({ name:'/' })
            } 
        },

        created(){
        this.allOrder();
        },

        data(){
          return{
            orders:[],
            searchTerm:'',         
          }
        },
       computed:{
         filtersearch(){
          return this.orders.filter(order => {
             //return order.name.match(this.searchTerm)
             return orders.name.toLowerCase().includes(this.searchTerm.toLowerCase()) || orders.status.toLowerCase().includes(this.searchTerm.toLowerCase())
           })
         }
       },
        methods:{
          allOrder(){
            axios.get('/api/orders/')
            .then(({data}) => (this.orders = data))
            .catch()
          },

          statuschange(id){
          axios.get('/api/statuschange/'+id,this.form)
            .then(({data}) => {
              (this.orders = data)
               Notification.success()
                 })
            
          },
          
         
        
        },
      
    }
     
  
  
</script>

<style>
	


</style>
