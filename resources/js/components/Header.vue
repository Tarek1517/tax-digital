<template>
    <header class=" bg-white shadow-md">
        <Container>
            <div class="lg:flex items-center hidden justify-between py-4">
              
			  <RouterLink to="/">
			  	<img class="h-10 w-auto" src="@/assets/images/tax-logo.png" alt="">
			  </RouterLink>

                 <!-- Navigation Links -->
                <nav class="flex space-x-8">
                    <RouterLink to="/" class="text-primary text-xl font-medium hover:text-primary-800">Home</RouterLink>
                    <RouterLink to="/about" class="text-gray-900 font-medium text-xl hover:text-primary">About</RouterLink>
                    <RouterLink to="/price" class="text-gray-900 font-medium text-xl hover:text-primary">Pricing</RouterLink>
                    <RouterLink to="/service" class="text-gray-900 font-medium text-xl hover:text-primary">Services</RouterLink>
                    <RouterLink to="/contact" class="text-gray-900 font-medium text-xl hover:text-primary">Contact</RouterLink>
                </nav>

                 <!-- Right Side (Contact Info & Buttons) -->
                    <div class="flex items-center space-x-4">
                       
        
                        <!-- Buy Now Dropdown -->
                        <div class="relative">
                        <button
                            class="px-4 py-2 font-medium bg-primary text-white rounded-lg hover:bg-secondary flex items-center space-x-1"
                        >
                            <span>Pricing</span>
                        </button>
                        <!-- Dropdown Menu (Hidden by default, shown on click) -->
                        <!-- Add dropdown functionality here -->
                        </div>
                    </div>
            </div>
        </Container>
    </header>
  </template>
  
  <script>
  export default {}
  </script>
  
  <style></style>
  