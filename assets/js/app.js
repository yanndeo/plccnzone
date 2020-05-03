
import '../css/app.css';
import React,{useState, useEffect} from 'react';
import ReactDOM from 'react-dom';

//Component
import Category from './components/category/index';
import Product from './components/product/index';
import Search from "./components/search/index";
import Pub from "./components/pub/index";
import Newsletter from "./components/newsletter/index";

//API
import { _getDefaultDataApi } from './actions/index';



const App = () => {

    const [products, setProducts] = useState([]);
    const [searchValue, setSearchValue] = useState('');
    const [categories, setCategories] = useState([]);

    useEffect(()=>{
        _getDefaultDataApi()
            .then((res)=>{
                setProducts(res.modifiedDataProducts);
                setCategories(res.categories);
            });
    },[]);





    /**
     * @param {*} value 
     */
    const mySearchFunction = (value) => {
        setSearchValue(value);
    } 






    return (
        
        <div className="row">
            <div div className="col-lg-4" >
                <div className="blog_right_sidebar">
                    <Search mySearchFunctionCallback={(value) => mySearchFunction(value) } />
                    <Pub/>
                    <Category data={categories} />
                    <Newsletter/>
                </div>
            </div>
            <div div className="col-lg-8" >
                <Product data={products} searchValue={searchValue} />
            </div>
        </div>
    )
}

ReactDOM.render( <App/> , document.getElementById('root'));