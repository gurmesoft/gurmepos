import{s as u,o,c as a,a as e,g as p,u as t,N as V,f as w,t as d,F as v,l as y,x as N,p as U,aj as C,a8 as B,d as $,ak as S,w as h,m as g,al as D,k as f,am as T,_ as E}from"../vendor/main.js";import{u as b}from"../CheckoutStore/main.js";import{_ as M}from"../_plugin-vue_export-helper/main.js";import{u as F}from"../ajax/main.js";const H={class:"bg-yellow-100 text-yellow-700 p-3 flex flex-col rounded gap-2"},I={class:"flex items-center gap-2 text-lg font-semibold"},j={key:0},A=e("th",null,null,-1),G={class:"hidden md:table-cell"},L=e("th",{class:"hidden md:table-cell"}," Cvc ",-1),R=e("th",{class:"hidden md:table-cell"}," 3ds ",-1),q=e("th",null,null,-1),z=["src"],J={class:"hidden md:table-cell"},K={class:"hidden md:table-cell"},O={class:"hidden md:table-cell"},we={__name:"TestMode",setup(_){const r=b(),{card:l}=u(r),{assetsUrl:n,gateway:s}=r,m=c=>{l.value.bin=c.bin,l.value.expiry_month=c.expiry_month,l.value.expiry_year=c.expiry_year,l.value.cvv=c.cvv};return(c,x)=>(o(),a("div",H,[e("div",I,[p(t(V),{class:"w-6"}),w(d(c.$t("test_mode_title")),1)]),e("div",null,d(c.$t("test_mode_checkout_desc")),1),t(s).test_cards.length>0?(o(),a("table",j,[e("tr",null,[A,e("th",null,d(c.$t("card_bin")),1),e("th",G,d(c.$t("month_year")),1),L,R,q]),e("tbody",null,[(o(!0),a(v,null,y(t(s).test_cards,(i,k)=>(o(),a("tr",{key:k,class:"!border-b !border-yellow-700"},[e("td",null,[e("img",{class:"w-8",src:`${t(n)}/images/card/${i.brand}.svg`},null,8,z)]),e("td",null,d(i.bin),1),e("td",J,d(i.expiry_month)+"/"+d(i.expiry_year),1),e("td",K,d(i.cvv),1),e("td",O,d(i.secure),1),e("td",null,[p(t(N),{class:"w-6 cursor-pointer",onClick:ye=>m(i)},null,8,["onClick"])])]))),128))])])):U("",!0)]))}},P={class:"flex w-full"},Q={class:"inline-flex relative px-3 items-center text-sm border border-r-0 border-gray-300 rounded-l !bg-white"},W=["placeholder"],ke={__name:"HolderName",setup(_){return(r,l)=>(o(),a("div",P,[e("span",Q,[p(t(C),{class:"w-6 h-6","aria-hidden":"true"})]),e("input",{type:"text",class:"!rounded-r !border-y !border-r !border-l-0 !w-full !border-gray-300 !bg-white !m-0",placeholder:r.$t("name_on_card"),name:"gpos-card-holder-name"},null,8,W)]))}};const X={},Y={class:"dot-spinner mx-3"},Z=B('<div class="dot-spinner__dot" data-v-739471c9></div><div class="dot-spinner__dot" data-v-739471c9></div><div class="dot-spinner__dot" data-v-739471c9></div><div class="dot-spinner__dot" data-v-739471c9></div><div class="dot-spinner__dot" data-v-739471c9></div><div class="dot-spinner__dot" data-v-739471c9></div><div class="dot-spinner__dot" data-v-739471c9></div><div class="dot-spinner__dot" data-v-739471c9></div>',8),ee=[Z];function te(_,r){return o(),a("div",Y,ee)}const se=M(X,[["render",te],["__scopeId","data-v-739471c9"]]),re={class:"flex w-full"},ne={class:"inline-flex relative items-center text-sm border border-r-0 border-gray-300 rounded-l !bg-white"},oe=["src"],ae=["placeholder"],Ve={__name:"BinNumber",setup(_){const r=b(),{loading:l}=u(F()),{card:n}=u(r),{assetsUrl:s}=r,m=c=>{["Delete","Backspace"].includes(c.key)||(n.value.bin=n.value.bin.replace(/[^0-9]/g,"").replace(/(\d{4})/g,"$1 ").slice(0,19))};return(c,x)=>(o(),a("div",re,[e("span",ne,[t(l)?(o(),$(se,{key:0})):["visa","mastercard"].includes(t(n).brand)?(o(),a("img",{key:1,class:"w-14 h-14 mx-1",src:`${t(s)}/images/card/${t(n).brand}.svg`},null,8,oe)):(o(),$(t(S),{key:2,class:"w-6 h-6 mx-3","aria-hidden":"true"}))]),h(e("input",{"onUpdate:modelValue":x[0]||(x[0]=i=>t(n).bin=i),class:"!rounded-r !border-y !border-r !border-l-0 !w-full !border-gray-300 !bg-white !m-0",placeholder:c.$t("card_bin"),name:"gpos-card-bin",inputmode:"numeric",type:"tel",autocomplete:"cc-number",onInput:m},null,40,ae),[[g,t(n).bin]])]))}},de={class:"flex w-full"},le={class:"inline-flex items-center px-3 text-sm border border-r-0 border-gray-300 rounded-l !bg-white"},ce={value:""},ie=["value","textContent"],_e={value:""},ue=["value","textContent"],Ne={__name:"Expire",setup(_){const{card:r}=u(b());return(l,n)=>(o(),a("div",de,[e("span",le,[p(t(D),{class:"w-6 h-6","aria-hidden":"true"})]),h(e("select",{"onUpdate:modelValue":n[0]||(n[0]=s=>t(r).expiry_month=s),name:"gpos-card-expiry-month",class:"border !border-x-0 !border-gray-300 text-gray-900 text-sm !rounded-none w-2/5 !bg-white focus:ring-0 focus:ring-offset-0"},[e("option",ce,d(l.$t("month")),1),(o(),a(v,null,y(["01","02","03","04","05","06","07","08","09","10","11","12"],s=>e("option",{key:s,value:s,textContent:d(s)},null,8,ie)),64))],512),[[f,t(r).expiry_month]]),h(e("select",{"onUpdate:modelValue":n[1]||(n[1]=s=>t(r).expiry_year=s),name:"gpos-card-expiry-year",class:"border !border-l-0 !border-gray-300 text-gray-900 text-sm !rounded-r !rounded-l-none w-3/5 !bg-white focus:ring-0 focus:ring-offset-0"},[e("option",_e,d(l.$t("year")),1),(o(),a(v,null,y(["2023","2024","2025","2026","2027","2028","2029","2030","2031","2032","2033"],s=>e("option",{key:s,value:s,textContent:d(s)},null,8,ue)),64))],512),[[f,t(r).expiry_year]])]))}},pe={class:"flex w-full"},me={class:"inline-flex items-center px-3 text-sm border border-r-0 border-gray-300 rounded-l !bg-white"},Ue={__name:"Cvc",setup(_){const{card:r}=u(b());return(l,n)=>(o(),a("div",pe,[e("span",me,[p(t(T),{class:"w-6 h-6","aria-hidden":"true"})]),h(e("input",{"onUpdate:modelValue":n[0]||(n[0]=s=>t(r).cvv=s),class:"!rounded-r !border-y !border-r !border-l-0 !w-full !border-gray-300 !bg-white !m-0",placeholder:"Cvc",name:"gpos-card-cvv",inputmode:"numeric",type:"tel",autocomplete:"cc-number"},null,512),[[g,t(r).cvv]])]))}},he={class:"hidden"},be=["onUpdate:modelValue","name"],Ce={__name:"HiddenCardData",setup(_){const{card:r}=u(b());return(l,n)=>(o(),a("div",he,[(o(),a(v,null,y(["type","brand","family","bank_name","country"],s=>h(e("input",{key:s,"onUpdate:modelValue":m=>t(r)[s]=m,type:"hidden",name:`gpos-card-${s.replaceAll("_","-")}`},null,8,be),[[g,t(r)[s]]])),64))]))}},ve={class:"w-full bg-red-200 text-red-700 p-3 rounded font-semibold flex gap-2"},Be={__name:"GatewayError",setup(_){return(r,l)=>(o(),a("div",ve,[p(t(E),{class:"w-10"}),w(" "+d(r.$t("gateway_error")),1)]))}};export{Ve as _,Ne as a,Ue as b,Ce as c,we as d,ke as e,Be as f};
