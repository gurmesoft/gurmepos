import{s as h,o,c as l,a as e,g as y,u as a,T as D,f as N,t as c,F as $,p as w,D as T,B as q,am as M,ac as j,d as C,an as A,w as g,l as B,ao as F,m as U,ap as H,a2 as I,aq as L}from"../vendor/main-fb93ded3.js";import{u as v}from"../CheckoutStore/main-c7f9700a.js";import{_ as Q}from"../_plugin-vue_export-helper/main-c27b6911.js";import{u as G,p as E}from"../ajax/main-d5bd04c6.js";const R={class:"bg-yellow-100 text-yellow-700 p-3 flex flex-col rounded gap-2"},z={class:"flex items-center gap-2 text-lg font-semibold"},J={key:0},K=e("th",null,null,-1),O={class:"hidden md:table-cell"},P=e("th",{class:"hidden md:table-cell"}," Cvc ",-1),W=e("th",{class:"hidden md:table-cell"}," 3ds ",-1),X=e("th",null,null,-1),Y=["src"],Z={class:"hidden md:table-cell"},ee={class:"hidden md:table-cell"},te={class:"hidden md:table-cell"},Se={__name:"TestMode",setup(i){const t=v(),{card:r}=h(t),{assetsUrl:s,gateway:n}=t,p=d=>{r.value.bin=d.bin,r.value.expiry_month=d.expiry_month,r.value.expiry_year=d.expiry_year,r.value.cvv=d.cvv};return(d,b)=>(o(),l("div",R,[e("div",z,[y(a(D),{class:"w-6"}),N(c(d.$t("test_mode_title")),1)]),e("div",null,c(d.$t("test_mode_checkout_desc")),1),a(n).test_cards.length>0?(o(),l("table",J,[e("tr",null,[K,e("th",null,c(d.$t("card_bin")),1),e("th",O,c(d.$t("month_year")),1),P,W,X]),e("tbody",null,[(o(!0),l($,null,w(a(n).test_cards,(_,f)=>(o(),l("tr",{key:f,class:"!border-b !border-yellow-700"},[e("td",null,[e("img",{class:"w-8",src:`${a(s)}/images/card/${_.brand}.svg`},null,8,Y)]),e("td",null,c(_.bin),1),e("td",Z,c(_.expiry_month)+"/"+c(_.expiry_year),1),e("td",ee,c(_.cvv),1),e("td",te,c(_.secure),1),e("td",null,[y(a(T),{class:"w-6 cursor-pointer",onClick:m=>p(_)},null,8,["onClick"])])]))),128))])])):q("",!0)]))}},se={class:"flex w-full"},ne={class:"inline-flex relative px-3 items-center text-sm border border-r-0 border-gray-300 rounded-l !bg-white"},ae=["placeholder"],De={__name:"HolderName",setup(i){return(t,r)=>(o(),l("div",se,[e("span",ne,[y(a(M),{class:"w-6 h-6","aria-hidden":"true"})]),e("input",{type:"text",class:"!rounded-r !border-y !border-r !border-l-0 !w-full !border-gray-300 !bg-white !m-0",placeholder:t.$t("name_on_card"),name:"gpos-card-holder-name"},null,8,ae)]))}};const re={},oe={class:"dot-spinner mx-3"},de=j('<div class="dot-spinner__dot" data-v-739471c9></div><div class="dot-spinner__dot" data-v-739471c9></div><div class="dot-spinner__dot" data-v-739471c9></div><div class="dot-spinner__dot" data-v-739471c9></div><div class="dot-spinner__dot" data-v-739471c9></div><div class="dot-spinner__dot" data-v-739471c9></div><div class="dot-spinner__dot" data-v-739471c9></div><div class="dot-spinner__dot" data-v-739471c9></div>',8),le=[de];function ce(i,t){return o(),l("div",oe,le)}const ie=Q(re,[["render",ce],["__scopeId","data-v-739471c9"]]),_e={class:"flex w-full"},ue={class:"inline-flex relative items-center text-sm border border-r-0 border-gray-300 rounded-l !bg-white"},pe=["src"],me=["placeholder"],Te={__name:"BinNumber",setup(i){const t=v(),{loading:r}=h(G()),{card:s}=h(t),{assetsUrl:n}=t,p=d=>{["Delete","Backspace"].includes(d.key)||(s.value.bin=s.value.bin.replace(/[^0-9]/g,"").replace(/(\d{4})/g,"$1 ").slice(0,19))};return(d,b)=>(o(),l("div",_e,[e("span",ue,[a(r)?(o(),C(ie,{key:0})):["visa","mastercard"].includes(a(s).brand)?(o(),l("img",{key:1,class:"w-14 h-14 mx-1",src:`${a(n)}/images/card/${a(s).brand}.svg`},null,8,pe)):(o(),C(a(A),{key:2,class:"w-6 h-6 mx-3","aria-hidden":"true"}))]),g(e("input",{"onUpdate:modelValue":b[0]||(b[0]=_=>a(s).bin=_),class:"!rounded-r !border-y !border-r !border-l-0 !w-full !border-gray-300 !bg-white !m-0",placeholder:d.$t("card_bin"),name:"gpos-card-bin",inputmode:"numeric",type:"tel",autocomplete:"cc-number",onInput:p},null,40,me),[[B,a(s).bin]])]))}},he={class:"flex w-full"},ve={class:"inline-flex items-center px-3 text-sm border border-r-0 border-gray-300 rounded-l !bg-white"},be={value:""},ye=["value","textContent"],ge={value:""},fe=["value","textContent"],qe={__name:"Expire",setup(i){const{card:t}=h(v());return(r,s)=>(o(),l("div",he,[e("span",ve,[y(a(F),{class:"w-6 h-6","aria-hidden":"true"})]),g(e("select",{"onUpdate:modelValue":s[0]||(s[0]=n=>a(t).expiry_month=n),name:"gpos-card-expiry-month",autocomplete:"cc-exp-month",class:"border !border-x-0 !border-gray-300 text-gray-900 text-sm !rounded-none w-2/5 !bg-white focus:ring-0 focus:ring-offset-0"},[e("option",be,c(r.$t("month")),1),(o(),l($,null,w(["01","02","03","04","05","06","07","08","09","10","11","12"],n=>e("option",{key:n,value:n,textContent:c(n)},null,8,ye)),64))],512),[[U,a(t).expiry_month]]),g(e("select",{"onUpdate:modelValue":s[1]||(s[1]=n=>a(t).expiry_year=n),name:"gpos-card-expiry-year",autocomplete:"cc-exp-year",class:"border !border-l-0 !border-gray-300 text-gray-900 text-sm !rounded-r !rounded-l-none w-3/5 !bg-white focus:ring-0 focus:ring-offset-0"},[e("option",ge,c(r.$t("year")),1),(o(),l($,null,w(["2023","2024","2025","2026","2027","2028","2029","2030","2031","2032","2033"],n=>e("option",{key:n,value:n,textContent:c(n)},null,8,fe)),64))],512),[[U,a(t).expiry_year]])]))}},xe={class:"flex w-full"},$e={class:"inline-flex items-center px-3 text-sm border border-r-0 border-gray-300 rounded-l !bg-white"},Me={__name:"Cvc",setup(i){const{card:t}=h(v());return(r,s)=>(o(),l("div",xe,[e("span",$e,[y(a(H),{class:"w-6 h-6","aria-hidden":"true"})]),g(e("input",{"onUpdate:modelValue":s[0]||(s[0]=n=>a(t).cvv=n),class:"!rounded-r !border-y !border-r !border-l-0 !w-full !border-gray-300 !bg-white !m-0",placeholder:"Cvc",name:"gpos-card-cvv",inputmode:"numeric",type:"tel",autocomplete:"cc-csc"},null,512),[[B,a(t).cvv]])]))}},we={class:"hidden"},ke=["onUpdate:modelValue","name"],je={__name:"HiddenCardData",setup(i){const{card:t}=h(v());return(r,s)=>(o(),l("div",we,[(o(),l($,null,w(["type","brand","family","bank_name","country"],n=>g(e("input",{key:n,"onUpdate:modelValue":p=>a(t)[n]=p,type:"hidden",name:`gpos-card-${n.replaceAll("_","-")}`},null,8,ke),[[B,a(t)[n]]])),64))]))}},Ve={class:"w-full bg-red-200 text-red-700 p-3 rounded font-semibold flex gap-2"},Ae={__name:"GatewayError",setup(i){return(t,r)=>(o(),l("div",Ve,[y(a(I),{class:"w-10"}),N(" "+c(t.$t("gateway_error")),1)]))}},{card:u}=h(v(E)),{checkBin:Be}=v(E),V=window.jQuery,S=()=>{let i={};jQuery(".gpos-checkout-class :input").each((t,r)=>{let s=V(r);s.attr("name")==="gpos-installment"&&(s=V("input[name=gpos-installment]:checked")),!(s.attr("type")==="checkbox"&&!s.is(":checked"))&&(i[s.attr("name")]=s.val())}),document.dispatchEvent(new CustomEvent("gpos-inputs-changed",{detail:i}))};L(u,S,{deep:!0});V(document).on({input:S},".gpos-checkout-class :input");let k="",x=null;document.addEventListener("gpos-inputs-changed",async i=>{var r,s,n,p,d,b,_,f;const t=await((r=i.detail["gpos-card-bin"])==null?void 0:r.replaceAll(/\s/g,"").slice(0,8));if((!t||t.length<8)&&(k="",u.value.type="",u.value.brand="",u.value.family="",u.value.bank_name="",u.value.country=""),k!==t&&t.length===8){k=t,x&&x.abort(),x=Be(t);const m=await x;m&&m.success&&(u.value.type=(s=m.data)==null?void 0:s.type,u.value.brand=(n=m.data)==null?void 0:n.scheme,u.value.family=(p=m.data)==null?void 0:p.family,u.value.bank_name=(b=(d=m.data)==null?void 0:d.bank)==null?void 0:b.name,u.value.country=(f=(_=m.data)==null?void 0:_.country)==null?void 0:f.name)}});export{Te as _,qe as a,Me as b,je as c,Se as d,De as e,Ae as f,S as i};
