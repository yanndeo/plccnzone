import React, { Component } from 'react'
import {BootstrapTable, TableHeaderColumn} from 'react-bootstrap-table';
import Skeleton from 'react-loading-skeleton';
import {capitalize } from '../../actions/index';




class Index extends Component {

    constructor(props){
      super(props);

      this.rowEvent = {
        onClick: (e, row, rowIndex) => {
           alert(row)
        }
      };

      this.selectRow = {
        mode: 'radio',
        bgColor: 'orange',
        hideSelectColumn: true,
        clickToSelect: true,
        onSelect: (row, isSelect, rowIndex, e) => {
          console.log(row.id);
        }
      };

    }



    render () {

      const {data, searchValue} = this.props;



      /* OPTIONS */
        const options = {
            page: 1,
            sizePerPage: 21,
            onRowClick: function(row, rowIndex, columnIndex, event){
            }
        };


        /* Personnalisation d'un champs */
        function colFormatter(cell, row){
            return (
                <span>
                    <a href={`/article/${row.slug}-${row.id}`} style={{textDecoration:'none', color:'grey'}}> {cell} </a>
                </span>
            )
        }


        /* function priceFormatter(cell, row){
            return  brand.name ;
        }

        function truncateText(cell, row){
              description.substring(0, 13)
        } */



        let renderData ;
        if(data && data.length > 0){

            var products = data;

            if (searchValue) {
               products = products.filter((pb) => pb.libelle.indexOf(capitalize(searchValue)) != -1)
            }

            renderData = (
              <BootstrapTable 
                    data={products} striped hover
                    options ={options}
                    pagination={ true }
                    search={ false }
                    multiColumnSearch={ true }
                    selectRow={this.selectRow }
                    rowEvents={this.rowEvent}>
                  <TableHeaderColumn isKey dataField='reference' dataFormat={colFormatter}>REFERENCE </TableHeaderColumn>
                  <TableHeaderColumn dataField='libelle' dataFormat={colFormatter}> EQUIPEMENT </TableHeaderColumn>
                  <TableHeaderColumn dataField='fabricant' dataFormat={colFormatter}> FABRICANT </TableHeaderColumn>
              </BootstrapTable>
            )

        }else{
          renderData = <Skeleton count ={14} height={40} />
        }




        return (

          <div className="blog_left_sidebar">
            {renderData}
          </div>
        );
    }
}

export default Index