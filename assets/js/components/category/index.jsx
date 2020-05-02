import React from 'react'
import Item from './item';

const Index = (props) => {

	const {data} = props
    return (
        <aside className="single_sidebar_widget post_category_widget">
			<h4 className="widget_title">Categories</h4>
				<ul className="list cat-list">
						
					{
						data.map((category,i) => { return <Item key = {i}  category={category} /> })
					}		
				</ul>
			    <div className="br"></div>
		</aside>
    )
}

export default Index