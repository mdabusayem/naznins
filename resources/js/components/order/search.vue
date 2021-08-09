 <template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Search Order</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row container">
         <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Search Orders 
            <router-link to="/order" class="btn btn-sm btn-info" id="add_new"> Today Order</router-link>
          </div>
          <div class="row">
          	<div class="col-lg-6">
          	  <form @submit.prevent="searchDate">
	            <div class="card-body">
	                <div class="form-group">
		              <div class="form-row">
		               <div class="col-md-12">
		                <div class="form-group">
						   <label for="exampleFormControlSelect2">Search By Date</label>
						    <input type="date" required="" class="form-control" v-model="form.date">
						  </div>
		               </div><br>
		               <button type="submit" class="btn btn-success">Search</button>
		             </div>
		            </div>     
		          </div>
	              
	            </form>
          	</div>
          	<div class="col-lg-6">
          	  <form @submit.prevent="searchMonth">
	            <div class="card-body">
	                <div class="form-group">
		              <div class="form-row">
		               <div class="col-md-12">
		               <div class="form-group">
		                   <label for="exampleFormControlSelect2">Search By Month</label>
		                   <select  class="form-control" id="exampleFormControlSelect2" v-model="form.month">
		                     <option value="January">January</option>
		                     <option value="February">February</option>
		                     <option value="March">March</option>
		                     <option value="April">April</option>
		                     <option value="May">May</option>
		                     <option value="june">june</option>
		                     <option value="July">July</option>
		                     <option value="August">August</option>
		                     <option value="September">September</option>
		                     <option value="October">October</option>
		                     <option value="November">November</option>
		                     <option value="December">December</option>
		                   </select>
		                 </div>
		               </div><br>
		               <button type="submit" class="btn btn-success">Search</button>
		             </div>
		            </div>     
		          </div>
	              
	            </form>
          	</div>

          </div>
          </div>
         </div>
  <div class="row card container">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
             Orders
           
          </div>
          <div class="card-body" >
            <div class="card-body">
              <div class="table-responsive">
                <label>Search</label>
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
        data(){
        	return{
        		form:{
        			date :'',
        			month:''
        		},
            errors:{},
        		orders:[],
            searchTerm:'',
        	}
        },
        computed:{
         filtersearch(){
          return this.orders.filter(order => {
             //return order.name.match(this.searchTerm)
             return order.name.toLowerCase().includes(this.searchTerm.toLowerCase()) || order.status.toLowerCase().includes(this.searchTerm.toLowerCase())
           })
         }
       },
        

        methods:{ 	
        	searchDate(){
        		axios.post('/api/search/order',this.form)
        		.then(({data}) => (this.orders = data))
        		.catch(error => this.errors = error.response.data.errors)
        	},
        	searchMonth(){
        		axios.post('/api/search/month',this.form)
        		.then(({data}) => (this.orders = data))
        		.catch(error => this.errors = error.response.data.errors)
        	}
        	
        	
        }

    	
    }



  
</script>

<style>
	
#add_new{
	float: right;
}

</style>
