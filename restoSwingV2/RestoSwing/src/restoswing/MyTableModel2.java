/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package restoswing;
import java.util.ArrayList;
import javax.swing.table.AbstractTableModel;

/**
 *
 * @author antoine
 */
public class MyTableModel2 extends AbstractTableModel {

    private ArrayList<Ligne> lignes;

    // noms des colonnes
    private String[] lignes_cmd = {"ID-produit", "Plat", "Quantite"};

    // constructeur
    public MyTableModel2(ArrayList<Ligne> lignes){
        this.lignes = lignes;
    }

    // nombre de lignes
    public int getRowCount() {
        return lignes.size();
    }

    // nombre de colonnes
    public int getColumnCount() {
        return lignes_cmd.length;
    }

    // nom des colonnes
    public String getColumnName(int col){
        return lignes_cmd[col];
    }

    // valeur à afficher dans une cellule
    public Object getValueAt(int row, int col) {

        Ligne l = lignes.get(row);

        // on crée un tableau avec les valeurs de la commande
        Object[] values = {
            l.getIdProduit(),
            l.getPlat(),
            l.getQuantite()
        };
        // on retourne la valeur correspondant à la colonne
        return values[col];
    }
}
