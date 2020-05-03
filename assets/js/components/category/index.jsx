import React from 'react'
import Item from './item';
import Skeleton from 'react-loading-skeleton';



const Index = (props) => {

	const {data} = props;
	let renderData;

	if(data && data.length > 0){
		renderData =  data.map((category,i) => { return <Item key = {i}  category={category} /> }) 
	}else{
		renderData = <Skeleton count={6} /> ;
	}

    return (
		<aside className="single_sidebar_widget post_category_widget">
			<h4 className="widget_title">Categories</h4>
				<ul className="list cat-list">
					{renderData}
				</ul>
			<div className="br"></div>
		</aside>
		
    )
}

export default Index