import React from 'react'

const Item = ({category:{name, countProducts}}) => {
    return (
        <li>
            <a href="#" className="d-flex justify-content-between">
                <p>{name}</p>
                <p>{countProducts}</p>
            </a>
		</li>
    )
}

export default Item