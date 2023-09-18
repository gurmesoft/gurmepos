import{i as C,S as g,o as d,c as l,a as s,u as t,d as f,e as m,f as u,t as a,n as x,g as y,N as h,s as b,F as $,l as k,B,C as S}from"../vendor/main.js";import{a as w,p as j}from"../ajax/main.js";import{S as A}from"../SetDefaultBadge/main.js";import{_ as D}from"../PrimaryButton/main.js";import{u as F}from"../CheckoutStore/main.js";/* empty css              *//* empty css                               */const N=C("UserSavedCards",{state:()=>({isProActive:window.gpos.is_pro_active||!1,isTestMode:window.gpos.is_test_mode||!1,assetsUrl:window.gpos.asset_dir_url||"/",savedCards:window.gpos.saved_cards||[]}),actions:{async setDefault(e){await w.post("set_default_saved_card",{id:e}),this.swalFire()},async deleteCard(e){await w.post("delete_saved_card",{id:e}),this.swalFire()},swalFire(){g.fire({text:window.gpos.alert_texts.process_success,icon:"success",confirmButtonText:window.gpos.alert_texts.ok,confirmButtonColor:"#1A56DB"}).then(()=>window.location.reload())}}}),T={class:"w-full flex bg-[#fbfbfb] border rounded border-gray-200 px-3 py-4 items-center"},U={class:"w-2/12 flex justify-center"},V=["src","alt"],L={class:"w-2/12"},q={class:"w-3/12"},z={class:"w-2/12 text-end"},E={class:"w-1/12 text-end"},I={class:"w-2/12 flex justify-end items-center gap-1"},M={__name:"SavedCard",props:{savedCard:{required:!0,type:Object}},setup(e){const{assetsUrl:r,setDefault:c,deleteCard:_,savedCards:o}=N();return(i,n)=>(d(),l("div",T,[s("div",U,[s("img",{class:"w-9 h-9 object-contain rounded-md",src:`${t(r)}/images/card/${e.savedCard.card_family?e.savedCard.card_family.toLowerCase().replaceAll(/\s/g,""):"default"}.svg
          `,alt:e.savedCard.card_family},null,8,V)]),s("div",L,[e.savedCard.default?(d(),f(A,{key:0},{default:m(()=>[u(a(i.$t("default")),1)]),_:1})):(d(),f(D,{key:1,class:"!inline-flex !items-center !bg-blue-700 !text-white !text-xs !font-medium !mr-2 !px-2.5 !py-0.5 !rounded-full",onClick:n[0]||(n[0]=p=>t(c)(e.savedCard.id))},{default:m(()=>[u(a(i.$t("make_default")),1)]),_:1}))]),s("div",q,a(e.savedCard.card_name||i.$t("saved_card")),1),s("div",z,a(e.savedCard.masked_card_bin),1),s("div",E,a(e.savedCard.card_expiry_month)+"/"+a(e.savedCard.card_expiry_year.substr(-2)),1),s("div",I,[s("div",{class:x(`flex items-center justify-end gap-1 ${!e.savedCard.default||t(o).length===1?"text-red-600 cursor-pointer":"pointer-events-none text-gray-300"}`),onClick:n[1]||(n[1]=p=>t(_)(e.savedCard.id))},[y(t(h),{class:"w-6 h-6"}),u(" "+a(i.$t("delete")),1)],2)])]))}},O={key:0,class:"w-full flex flex-col gap-3"},P={key:1},R={class:"w-full flex p-4 bg-blue-200 text-blue-600 rounded"},G={__name:"App",setup(e){const{savedCards:r}=b(F());return(c,_)=>t(r).length>0?(d(),l("div",O,[(d(!0),l($,null,k(t(r),o=>(d(),f(M,{key:o.id,"saved-card":o},null,8,["saved-card"]))),128))])):(d(),l("div",P,[s("div",R,a(c.$t("saved_card_not_found")),1)]))}},H=B({locale:"default",messages:window.gpos.strings}),v=S(G);v.use(j);v.use(H);v.mount("#app");
