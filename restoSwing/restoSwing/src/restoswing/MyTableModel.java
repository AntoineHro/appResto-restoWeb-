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
public class MyTableModel extends AbstractTableModel {

    private ArrayList<Commande> commandes;

    // noms des colonnes
    private String[] colonnes = {"ID_cmd", "ID_user", "Date", "Etat", "NB_plats", "Montant"};

    // constructeur
    public MyTableModel(ArrayList<Commande> commandes){
        this.commandes = commandes;
    }

    // nombre de lignes
    public int getRowCount() {
        return commandes.size();
    }

    // nombre de colonnes
    public int getColumnCount() {
        return colonnes.length;
    }

    // nom des colonnes
    public String getColumnName(int col){
        return colonnes[col];
    }

    // valeur à afficher dans une cellule
    public Object getValueAt(int row, int col) {

        Commande commandess = commandes.get(row);

        // on crée un tableau avec les valeurs de la commande
        Object[] values = {
            commandess.getIdCommande(),
            commandess.getIdUtilisateur(),
            commandess.getDate_commande(),
            commandess.getEtat(),
            commandess.getNbPlats(),
            commandess.getTotal_commande()
        };
        // on retourne la valeur correspondant à la colonne
        return values[col];
    }
}
