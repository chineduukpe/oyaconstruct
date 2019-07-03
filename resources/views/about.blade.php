@extends('layout')
@section('title')
 About Oyaconstruct
@endsection

@section('style')
<style type="text/css">
  
  
</style>
 
@endsection

@section('content')

    <section id="inner-headline">
      <div class="container mt-5">
        <div class="row">
          <div class="col-lg-4">
            <div class="inner-heading">
              <h2>Know us</h2>
            </div>
          </div>
          <div class="col-lg-8">
            <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{URL::to('index')}}"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item"><a href="{{URL::to('about')}}">Pages</a></li>
              <li class="breadcrumb-item active">About us</li>
            </ul>
          </nav>
          </div>
        </div>
      </div>
    </section>
    <section id="content">
      <div class="container">
        @if(session('success'))
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>
           
            <p>{{ session('success') }}</p>
          </strong></div>
          @endif
          @if(session('error'))
          <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button><strong>
           
            <p>{{ session('error') }}</p>
          </strong></div>
          @endif
           @if($errors->any())
              <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>
                @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
              </strong></div>
              @endif             
        <div class="row">
          <div class="col-lg-12">
            <div class="media text-muted pt-3">
              <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-danger">
              <strong class="d-block text-gray-dark">@Oyaconstruct</strong>
             Oyaconstruct.com is a one-stop-shop for everything about building construction online. Redimo Consulto, a consulting firm tailored at addressing various construction needs such as; surveying, site management, contracting as well as supplying construction materials for enormous building construction projects. Progressively, Redimo consulto launched an online retail store for building construction materials (www.redimoconsult.com) in 2012 and over the years, www.redimoconsult.com operated smoothly in its capacity but has now birthed Oya Construct Development Limited, a marketplace for everything about building construction online. We are now bigger and better with www.oyaconstruct.com “Nigeria’s #1 construction marketplace”. We launched in July, 2017 as an online retail company designed to become the market leader in the Web based sales of building construction materials from various categories; General Building Material (Blocks, Cement, Sand, Iron rods), Roofing, Timber/Wood, Furniture, Fittings/ fixtures, Doors & Windows, Plumbing and Electrical Installations, Safety and Work wear, Interior decorations (tiles, painting, designs and much more), Plants and equipments, External works (interlocking, landscaping e.t.c) and Diesel. 
            </p>
          </div>
          <div class="media text-muted pt-3">
              <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-danger">
              Technology is evolving and impacting the world today, sizeable populaces of Nigeria along with other countries of the world have come to accept e-Commerce for its enormous benefits to business and humans. Oyaconstruct.com is an e-Commerce retail marketplace focusing on building a community of manufacturers, sellers as well as buyers of building construction materials, real estate and building construction professionals. Our website aims at taking the building construction industry to a wider range of clientele/customers in a faster and convenient manner. Nigerians can now buy building construction materials online Nationwide on OyaConstruct.com while we ensure the deliveries of products and services to their door steps just in time.
            </p>
          </div>
            <div class="media text-muted pt-3">
              <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-danger">
              Oyaconstruct.com is a retail website which offers sellers and manufacturers of products in the building construction industry as well as real estate and professionals Nationwide the chance to sell their products/services on the website. To this end, Oyaconstruct.com will focus on offering fast, efficient and convenient services to their customers. Nigerians can now make purchases (through different payment methods) from their favorite manufacturers of building construction materials through the website without having to face the hassle of visiting individual physical offices/shops. To achieve this oyaconstruct.com is giving its buying customers the opportunities to conveniently purchase products from a wider selection of products/services and at the same time having their purchases delivered to their door steps, through our ever so efficient logistic partners.
            </p>
            </div>
            
          </div>
          <div class="col-lg-12 mt-5">
            <div class="accordion" id="accordion2">
              <div class="accordion-group bg-light p-2">
                <div class="accordion-heading btn btn-outline-danger">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                  Mission Statement </a>
                </div>
                <div id="collapseOne" class="accordion-body collapse in bg-white">
                  <div class="accordion-inner">
                    <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-danger">
                      <span class="text-center">
                      To electrify building construction experience with technology.
                    </span>
                    </p>
                  </div>
                </div>
              </div>
              <div class="accordion-group bg-white p-2">
                <div class="accordion-heading btn btn-outline-danger">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                Vision Statement</a>
                </div>
                <div id="collapseTwo" class="accordion-body collapse">
                  <div class="accordion-inner">
                    <p>
                        <ol class="list-group">
                          <li class="list-group-item">To be Nigerians’ one-stop-shop for everything about building construction online.</li>
                          <li class="list-group-item">To constantly focus on providing our customers with the best online shopping experience for building construction materials, real estates and building professional services.</li>
                          <li class="list-group-item">To provide an easy-to-navigate website, clear and secure payment methods, and fast, quality delivery.</li>
                        </ol>
                      
                    </p>
                  </div>
                </div>
              </div>
              <div class="accordion-group bg-light p-2">
                <div class="accordion-heading btn btn-outline-danger">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
               Our Services</a>
                </div>
                <div id="collapseThree" class="accordion-body collapse bg-white">
                  <div class="accordion-inner">
                    <p class="pb-3 mb-0 small lh-125 border-bottom border-danger">
                      <span>
                        We provide an online platform where sellers and manufacturers of products in the building construction industry can sell their products and services to a wider range of customers/clientele. We deliver as well as monitor deliveries of products to the customers. Our website provides millions of Internet users in Nigeria with a directory for professionals in the building construction industry i.e Architects, Builders, Surveyors, Engineers, and artisans. Below are details of oyaconstruct.com proposed services and their benefits:
                      </span>
                    </p>
                  <dl class="dl-horizontal pb-3 mb-0 small lh-125 border-bottom border-danger">
                    <dt>Digital marketing</dt>
                    <dd>This is where products/services will enjoy bigger, better and wider reach and closeness to prospects and buyers (millions of internet users). Wherever Oyaconstruct.com reaches, your products/services will be there also. We guarantee increased sale as result of increased business reach; product and services, and this includes being on Google top searches, building construction directories and organizational bodies, facebook, twitter, instagram and other relevant internet platforms.</dd>
                    <dt>Promotional projects</dt>
                    <dd>his is where we will do our best to give businesses professional advices for seasonal promotional offers and give away incentives to enable a product or service gain more attention as well as increased sale, and enjoy customer retention and brand loyalty.</dd>
                    <dt>Control</dt>
                    <dd>Vendors (sellers/owners) will have total control and will be allowed to decide whether or not their products can be paid for upon delivery or pay before delivery and also whether or not a product can be returned after delivery as well. We at oyaconstruct.com will only advice on what is best, give product feedback as a result of reviews and sale record so we (seller & oyaconstruct) can constantly figure out realistic and possible ways to satisfy our customers better.</dd>
                    <dt>Pricing</dt>
                    <dd>Vendors (sellers/owners) are totally in control of their pricing, we only help you by advising i.e how/why some products are best selling and the implication of your pricing; whether it is gain more sale or not. Also, the website has a feature that allow for negotiation (especially for bulk orders).</dd>
                    <dt>Communication</dt>
                    <dd>Our customer relationship team will be available round the clock to make communication smooth and easy; Customer – Oyaconstruct – Seller/Owner or Seller/Owner – Oyaconstruct – Customer.</dd>
                    <dt>Safety</dt>
                    <dd>Oyaconstruct.com will constantly work smart and hard to make sure that sellers and customers’ interests are duly protected with highly secured platform for data i.e card/banking details, personal information and other relevant details that shall be required during the use of the website. Also, we guarantee the safety of every payment that shall be made through oyaconstruct.com for all successful orders and deliveries.</dd>
                    <dt>Online store</dt>
                    <dd>Upon accepting to sell on Oyaconstruct.com, an online store (only for products with real estate inclusive) will be created on our sellers’ platform. This stores shall be for individual vendors with a dedicated staff assigned to help out with store management. Product upload shall be done strictly by oyaconstruct for the time being up until when vendors will become use to the operations of their individual stores. Sellers can however monitor sale, manage product and make immediate correction in a case of omission, wrong pricing or wrong product details.</dd>
                    <dt>Help</dt>
                    <dd>We shall assign dedicated agents to you to see you through managing your online store i.e from point of content creation to its final point of delivery as well as receiving payment for delivered items.</dd>
                    <dt>Professional directory</dt>
                    <dd>Part of the features of Oyaconstruct.com website is having a directory for building construction professionals; Engineers, Architects, Surveyors, and Artisans. These professionals will have details such as; Names, Organization, Contact details, Jobs executed (with pictorial representation), Strength and weakness. We do not just sell building construction materials, we as well sell professional services but in this case, we will be connecting these professionals to millions of prospects and customer/clientele and getting them more jobs. Also, customer/clientele can also go on oyaconstruct.com and request the services of these professionals 24/7 and request for artisans closest to them to attend to their urgent repairs/fixes at home or offices (home services like plumbing, electrical, painting and much more).</dd>
                    <dt>Real estate</dt>
                    <dd>Properties can also be sold, leased, or rented out on Oyaconstruct.com. Thousands of real estate companies and individuals can come on board with their properties and reach out to millions of internet users and people with such needs (prospects, customers and clients) to either sell, rent or lease their properties (with verifiable prove of ownership documents). In this category, just like selling an item on Oyaconstruct.com website, owners of properties will be totally in control of their properties by either choosing to have price ranges and allow for negotiations and the communication pattern will be same, easy and smooth i.e Customer – Oyaconstruct – Owner or Owner – Oyaconstruct – Customer. We will allow for exceptions in the channel of communication, the idea is for oyaconstruct.com to stand as intermediary between both parties all through to ensure maximum customer satisfaction and to reduce the risk of possible fraud cases.</dd>
                  </dl>
                  </div>
                </div>
              </div>
              <div class="accordion-group bg-white p-2">
                <div class="accordion-heading btn btn-outline-danger">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">
               Commission rate</a>
                </div>
                <div id="collapseFour" class="accordion-body collapse">
                  <div class="accordion-inner">
                    <p class="pb-3 mb-0 small lh-125 border-bottom border-danger">
                      <span>
                        We charge very low percentage for every product/item on our web site and this commission will only be deducted from successfully placed orders with complete payment. When we deliver an item regardless of whether it is pay on delivery or pay before delivery, the commission will be calculated per the price of individual store product/item on an order and deducted before payment is made to the vendor. However, when a vendor delivers to the customer for some reason and receives cash upon delivery, the vendor is expected to pay the commission to any of oyaconstruct.com bank account within three (3) working days and email a photocopied teller (or any other prove of payment) to an email address that shall be provided to the vendor. Failure to comply with the said time of remission to oyaconstruct.com, such vendors’ store shall be blocked and other necessary legal action will be taken. Our commission rate is by price range and the higher the prices, the lower the percentage for the commission, see details in the table below:
                      </span>
                    </p>
                     <table class="table pb-3 mb-0 small lh-125 border-bottom border-danger">
              <thead>
                <tr>
                  <th>
                    #
                  </th>
                  <th>
                    product Category
                  </th>
                  <th>
                    Commision 1
                  </th>
                  <th>
                    Commision 2
                  </th>
                  <th>
                    Commission 3
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    1
                  </td>
                  <td>
                    General building material
                  </td>
                  <td>
                     Paid orders from one naira {N1.00} to two million, four hundred and ninety-nine thousand, nine hundred and ninety nine naira, ninety nine kobo{N2, 499 , 999.99} attracts a commission rate of three point five percent only {3.5%} 
                  </td>
                  <td>
                    Paid orders from two million, five hundred thousand {N2, 500, 000.00} to nine million, nine hundred and ninety-nine thousand, naira hundred ninety – nine naira, ninety nine kobo {N9, 999, 999.99} attracts a commission rate of three point thirty eight percent only {3.38%}
                  </td>
                  <td>
                     Paid orders from ten million naira {10, 000, 000, 00} to infinity attracts a commission rate of three point thirty five percent {3.35%}.
                  </td>
                </tr>
                <tr>
                  <td>
                    2
                  </td>
                  <td>
                    
                  </td>
                  <td>
                    
                  </td>
                  <td>
                    
                  </td>
                  <td>
                    
                  </td>
                </tr>
                <tr >
                  <td>
                    3
                  </td>
                  <td>
                    
                  </td>
                  <td>
                    
                  </td>
                  <td>
                    
                  </td>
                  <td>
                    
                  </td>
                </tr>
                <tr>
                  <td>
                    4
                  </td>
                  <td>
                    
                  </td>
                  <td>
                    
                  </td>
                  <td>
                    
                  </td>
                  <td>
                    
                  </td>
                </tr>
              </tbody>
            </table>
                  </div>
                </div>
              </div>
                <div class="accordion-group bg-light p-2">
                <div class="accordion-heading btn btn-outline-danger">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFive">
                Payment method</a>
                </div>
                <div id="collapseFive" class="accordion-body collapse bg-white">
                  <div class="accordion-inner">
                    <p class="pb-3 mb-0 small lh-125 border-bottom border-danger">
                      <span>
                        The website will allow for different payment methods:
                      </span>
                    </p>
                    <p>
                      <ul class="list-group">
                        <li class="list-group-item">Online bank transfer to any of our bank accounts.</li>
                        <li class="list-group-item">C.O.D cash on delivery (relative to product)</li>
                        <li class="list-group-item">Various debit card payments (Master Card, verve, visa, etc.)</li>
                      </ul>
                    </p>
                    
                  </div>
                </div>
              </div>
              <div class="accordion-group bg-white p-2">
                <div class="accordion-heading btn btn-outline-danger">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseSix">
                  Delivery</a>
                </div>
                <div id="collapseSix" class="accordion-body collapse">
                  <div class="accordion-inner">
                    <p class="pb-3 mb-0 small lh-125 border-bottom border-danger">
                      <span>
                        Before payments are made, the website will allow the buying customer to select from different delivery methods:
                      </span>
                    </p>
                    <p>
                      <ul class="list-group">
                        <li class="list-group-item">Same day delivery (only within Abuja central area and depending on the product)</li>
                        <li class="list-group-item">Next day delivery (anywhere within Abuja and depending on the product)</li>
                        <li class="list-group-item">Standard delivery within Abuja (2-4 days)</li>
                        <li class="list-group-item">Standard delivery within Abuja (3-14 days)</li>
                      </ul>
                    </p>
                    <p class="pb-3 mb-0 small lh-125 border-bottom border-danger">
                      <span>
                        For the first six month of operations, oyaconstruct.com will limit buying and selling to only Abuja FCT to enable us stand on our fit proper before we start extending to other cities and any of such changes shall be communicated duly to everyone who uses www.oyaconstruct.com.
                      </span>
                    </p>
                  </div>
                </div>
              </div>
            </div>


          </div>
        </div>

        
      </div>
    </section>
@endsection
