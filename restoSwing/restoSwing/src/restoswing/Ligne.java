/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package restoswing;
/**
 *
 * @author antoine
 */
public class Ligne {
    public int idProduit;
    public String plat;
    public int quantite;
    
    public Ligne(int idProduit, String plat, int quantite){
        this.idProduit = idProduit;
        this.plat = plat;
        this.quantite = quantite;
    }
            
    public void afficher(){
        System.out.println("");
        System.out.println("ID-produit" + idProduit);
        System.out.println("Plat" + plat);
        System.out.println("Quantite" + quantite);
    }
}
