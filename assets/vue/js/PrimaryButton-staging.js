import{o as n,c as s,r as l,n as o}from"./vendor-staging.js";const i=["disabled","href"],a=["disabled"],u={__name:"PrimaryButton",props:{href:{type:String,default:""},disabled:{type:Boolean,default:!1}},setup(e){return(t,r)=>e.href?(n(),s("a",{key:0,disabled:e.disabled,href:e.href,class:"!text-white bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2"},[l(t.$slots,"default")],8,i)):(n(),s("button",{key:1,disabled:e.disabled,type:"button",class:o(`text-white ${e.disabled?"bg-gray-300":" bg-blue-700"} focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2`)},[l(t.$slots,"default")],10,a))}};export{u as _};
