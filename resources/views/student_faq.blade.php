@extends('layouts.app')

@section('before_body')

<style>
  

.Accordion {
  padding-top: 60px;
  padding-bottom: 60px;
}
.Accordion__tabs {
  max-width: 80%;
    list-style: none;
    margin: auto;
}
.Accordion__tab {
  width: 100%;
}
.Accordion__tab__headline {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 1px solid rgb(0 0 0 / 50%);
  transition: 0.2s ease all;
  padding: 20px 15px;
  cursor: pointer;
  font-weight: 400;
}
.Accordion__tab__headline:hover {
  background-color: #fd610094;
}
.Accordion__tab__headline > h4 {
  user-select: none;
  text-transform: uppercase;
  margin: 0;
}
.Accordion__tab__headline .icon {
  display: inline-block;
  width: 22px;
  height: 22px;
  border: 1px solid #000;
  border-radius: 22px;
  position: relative;
}
.Accordion__tab__headline .icon::before {
  display: block;
  position: absolute;
  content: "";
  top: 10px;
  left: 5px;
  width: 10px;
  height: 2px;
  background: black;
}
.Accordion__tab__headline .icon::after {
  display: block;
  position: absolute;
  content: "";
  top: 6px;
  left: 9px;
  width: 2px;
  height: 10px;
  background: black;
  transition: 0.2s ease all;
}
.Accordion__tab__content {
  overflow: hidden;
  padding: 10px 15px 0;
  box-sizing: border-box;
  height: 100%;
  max-height: 0;
  transition: 0.4s ease all;
}
.Accordion__tab--open .Accordion__tab__headline .icon::after {
  transform: scaleY(0);
}
</style>


@endsection


@section('content')
    <section class="inner_page_breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 text-center">
                    <div class="breadcrumb_content">
                        <h4 class="breadcrumb_title">Student FAQs</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Instructor FAQs</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

<section class="Accordion">
  <div class="container">
    
  <ul class="Accordion__tabs">
    @foreach($faqs as $faq)
    <li class="Accordion__tab" onclick="toggleAccordion(this)">
      <div class="Accordion__tab__headline">
        <h4>{{$faq->question}}</h4><span class="icon"></span>
      </div>
      <div class="Accordion__tab__content">
        <div class="wrapper">
          <p>{{$faq->answer}}
          </p>
        </div>
      </div>
    </li>
    @endforeach
   
  </ul>
  </div>
</section>

@endsection


@section('afterScript')

<script>
  
  var elementOld = null;
var openClass = "Accordion__tab--open";

function toggleAccordion(element) {
    content = element.querySelector(".Accordion__tab__content");

    if(elementOld != null){
        elementOld.classList.remove(openClass);
        contentOld = elementOld.querySelector(".Accordion__tab__content");
        contentOld.style.maxHeight = "0px";
    }

    if(elementOld !== element){
        element.classList.add(openClass);
        content.style.maxHeight = content.scrollHeight + "px";
        elementOld = element;
    }else{
        elementOld = null;
    }
}


</script>
@endsection