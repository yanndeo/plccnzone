import React, { Component } from 'react'
import {BootstrapTable, TableHeaderColumn} from 'react-bootstrap-table';




class Index extends Component {

    constructor(props){
      super(props);
      this.state = {
        articles:[
          {
            id: 1,
            name: "Product1",
            price: 120
          }, {
            id: 2,
            name: "Product2",
            price: 80
          },
          {
            id: 3,
            name: "Product2",
            price: 80
          }
        ],
      }

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

      const {data} = this.props;
      console.log('props', data)

      var products = data;

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


        function priceFormatter(cell, row){
            return  brand.name ;
        }

        function truncateText(cell, row){
              description.substring(0, 13)
        }


        return (

          <div className="blog_left_sidebar">

           <BootstrapTable data={products} striped hover
                            options ={options}
                            pagination={ true }
                            search={ false }
                            multiColumnSearch={ true }
                            selectRow={this.selectRow }
                            rowEvents={this.rowEvent}>

                <TableHeaderColumn isKey dataField='reference' dataFormat={colFormatter}>REFERENCE. </TableHeaderColumn>

                <TableHeaderColumn dataField='libelle' dataFormat={colFormatter}> EQUIPEMENT </TableHeaderColumn>

                <TableHeaderColumn dataField='fabricant' dataFormat={colFormatter}> FABRICANT </TableHeaderColumn>
            </BootstrapTable>


            <nav className="blog-pagination justify-content-center d-flex">
              <ul className="pagination">
                <li className="page-item">
                  <a href="#" className="page-link" aria-label="Previous">
                    <span aria-hidden="true">
                      <span className="lnr lnr-chevron-left"></span>
                    </span>
                  </a>
                </li>
                <li className="page-item">
                  <a href="#" className="page-link">
                    01
                  </a>
                </li>
                <li className="page-item active">
                  <a href="#" className="page-link">
                    02
                  </a>
                </li>
                <li className="page-item">
                  <a href="#" className="page-link">
                    03
                  </a>
                </li>
                <li className="page-item">
                  <a href="#" className="page-link">
                    04
                  </a>
                </li>
                <li className="page-item">
                  <a href="#" className="page-link">
                    09
                  </a>
                </li>
                <li className="page-item">
                  <a href="#" className="page-link" aria-label="Next">
                    <span aria-hidden="true">
                      <span className="lnr lnr-chevron-right"></span>
                    </span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        );
    }
}

export default Index